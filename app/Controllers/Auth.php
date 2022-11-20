<?php

namespace App\Controllers;

use App\Models\M_Users;
use App\Models\M_Usertoken;
use CodeIgniter\I18n\Time;

class Auth extends BaseController

{

    public function registrasi()
    {
        // tampilkan data prodi
        $prodi   = $this->db->query("SELECT * FROM prodi")->getResultArray();
        // menampung data kedalam array
        $data = [
            'prodi'        => $prodi,
        ];
        // menampilkan view registrasi
        return view('auth/registrasi', $data);
    }

    public function proses_registrasi()
    {
        // validasi inputan dari form registrasi
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama minimal 4 Karakter',
                    'max_length' => 'Nama maksimal 100 Karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|min_length[10]|max_length[100]|is_unique[users.email]|valid_email|trim',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'min_length' => 'Email minimal 10 Karakter',
                    'max_length' => 'Email maksimal 100 Karakter',
                    'is_unique' => 'Email sudah digunakan sebelumnya',
                    'valid_email' => 'Email tidak valid',
                    'trim' => 'Email tidak boleh ada spasi'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[5]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Username minimal 5 Karakter',
                    'max_length' => 'Username maksimal 50 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[50]|is_unique[users.password]|trim',
                'errors' => [
                    'required' => 'Password Harus diisi',
                    'min_length' => 'Password minimal 5 Karakter',
                    'max_length' => 'Password maksimal 50 Karakter',
                    'is_unique' => 'Password sudah digunakan sebelumnya',
                    'trim' => 'Password tidak boleh ada spasi'
                ]
            ],
            'password2' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sesuai dengan password',
                ]
            ],
            'id_prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program studi harus dipilih',
                ]
            ],
            'sebagai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Daftar sebagai apa harus dipilih',
                ]
            ],
        ])) {
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        // inisialisasi model
        $users = new M_users();
        // menangkap value post dari view
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $id_prodi = $this->request->getVar('id_prodi');
        $sebagai = $this->request->getVar('sebagai');
        $token_kelompok = $this->request->getVar('token_kelompok');
        // jika daftar sebagai anggota
        if($sebagai == "2"){
            $cek_token_kelompok = $this->db->query("SELECT * FROM users WHERE token_kelompok = '" .$this->db->escapeString($token_kelompok). "' AND status_kelompok='1' ")->getRowArray();
            if($cek_token_kelompok){
                $users->insert([
                    'id_kelompok'       => $cek_token_kelompok['id_kelompok'],
                    'id_prodi'          => $id_prodi,
                    'nama'              => $nama,
                    'username'          => $username,
                    'password'          => $password,
                    'email'             => $email,
                    'photo'             => 'default.png',
                    'roles'             => 'peserta',
                    'token_kelompok'    => $cek_token_kelompok['token_kelompok'],
                    'status_kelompok'   => '2',
                ]);
                // menampilan alert sukses registrasi
                session()->setFlashdata('flashdata', 'success');
                session()->setFlashdata('message', 'Pendaftaran akun berhasil, silahkan login');
                return redirect()->to(site_url('/login'));
            }else{
                // menampilan alert gagal registrasi token kelompok salah
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Pendaftaran gagal, token kelompok salah');
                return redirect()->back()->withInput();
            }
        }else{
            // jika daftar sebagai ketua
            // membuat kode random untuk kode kelompok dan token kelompok
            $custom_code = $this->db->query("SELECT NOW()+0 AS id_kelompok, LEFT(MD5(RAND()),16) AS token_kelompok")->getRowArray();
            // insert data ke tabel users
            $users->insert([
                'id_kelompok'       => $custom_code['id_kelompok'],
                'id_prodi'          => $id_prodi,
                'nama'              => $nama,
                'username'          => $username,
                'password'          => $password,
                'email'             => $email,
                'photo'             => 'default.png',
                'roles'             => 'peserta',
                'token_kelompok'    => $custom_code['token_kelompok'],
                'status_kelompok'   => '1',
            ]);
            // menampilan alert sukses registrasi
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Pendaftaran akun berhasil, silahkan login');
            return redirect()->to(site_url('/login'));
        }
    }

    public function index()
    {
        // menampilkan view login
        return redirect()->to(site_url('/login'));
    }

    public function login()
    {
        // jika ada session users maka langsung masuk ke aplikas, jika tidak maka kembalikan ke halaman login
        if(session('id_users')){
            return redirect()->to(site_url('/home'));
        }
        return view('auth/login');
    }

    public function proseslogin()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|max_length[50]|trim',
                'errors' => [
                    'required' => 'email/username harus diisi',
                    'max_length' => 'email/username maksimal 50 karakter',
                    'trim' => 'email/username tidak boleh ada spasi'
                ]
            ],
            'password' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'password harus diisi',
                    'max_length' => 'password maksimal 50 Karakter'
                ]
            ],
        ])) {
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        // mengambil post dari view
        $email = $this->request->getVar('email');
        $password = md5($this->request->getVar('password'));
        // cek jika email/username
        $cek_email_username = $this->db->query(" SELECT * FROM users WHERE (email = '" .$this->db->escapeString($email). "' OR username = '" .$this->db->escapeString($email). "') ")->getRowArray();
        if($cek_email_username) {
            // cek password
            $cek_password = $this->db->query(" SELECT * FROM users WHERE password = '" .$this->db->escapeString($password). "' ")->getRowArray();
            if($cek_password){
                $akun_valid = $this->db->query(" SELECT * FROM users WHERE (email = '" .$this->db->escapeString($email). "' OR username = '" .$this->db->escapeString($email). "') AND password = '" .$this->db->escapeString($password). "' ")->getRowArray();
                // jika akun cocok maka set session
                session()->set([
                    'id_users'          => $akun_valid['id_users'],
                    'id_kelompok'       => $akun_valid['id_kelompok'],
                    'id_prodi'          => $akun_valid['id_prodi'],
                    'nama'              => $akun_valid['nama'],
                    'photo'             => $akun_valid['photo'],
                    'roles'             => $akun_valid['roles'],
                    'status_kelompok'   => $akun_valid['status_kelompok'],
                    'tahun'             => new Time('now'),
                    'logged_in'         => TRUE
                ]);
                // jika akun cocok maka masuk ke halaman home
                return redirect()->to(site_url('/home'));
            }else{
                // jika salah tampilkan alert gagal login
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Password salah!');
                return redirect()->back()->withInput();
            }
        }else{
            // jika salah tampilkan alert gagal login
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Email/Nama Pengguna tidak terdaftar!');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        // hilangkan semua session
        session()->destroy();
        return redirect()->to(site_url('/login'));
    }

}
