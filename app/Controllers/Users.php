<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Users extends BaseController
{
    public function index()
	{
		// ambil session dan tampung kedalam variabel
		$roles = session('roles');
		$myTime = new Time('now');

		// cek roles akun
		if ($roles=="admin"){
            // proses menampilkan data selain peserta
            // inisialisasi model
            $model = new \App\Models\M_users();
            // membuat perulangan nomor no++ dengan mengambil nilai url pagination
            $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1 ;
            // variabel jumlah data yang ditampilkan dalam pagination
            $jumlah_baris_data = 5;
            
            // menangkap data pencarian
            $keyword = $this->request->getVar('keyword');
            // kondisi jika ada pencarian atau tidak
            if($keyword){
                $cari_data = $model->pencarian($keyword);
            } else {
                $cari_data = $model->tampil_data();
            };
            // menampung data kedalam variabel array untuk ditampilan ke view
            $data = [
                'data_pagination'           => $cari_data->paginate($jumlah_baris_data, 'default'),
                'pager'                     => $cari_data->tampil_data()->pager,
                'currentPage'               => $currentPage,
                'jumlah_baris_data'         => $jumlah_baris_data,
                'keyword'                   => $keyword,
            ];
            return view('admin/users/users', $data);
            // proses manampilkan data admin
			
		}else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
		}
	}

    public function tambah()
	{
		// ambil session dan tampung kedalam variabel
		$roles = session('roles');
		$myTime = new Time('now');

		// cek roles akun
		if ($roles=="admin"){
            // query tampilkan pilihan prodi
            $prodi   = $this->db->query(" SELECT * FROM prodi ")->getResultArray();
            // menampung data kedalam variabel array untuk ditampilan ke view
            $data = [
                'prodi'           => $prodi,
            ];
            return view('admin/users/tambah', $data);
            // proses manampilkan data admin
			
		}else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
		}
	}

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'roles' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'roles harus dipilih'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama harus diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'email harus diisi'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }
        
        // membuat variabel session
        $now = new Time('now');
        // menangkap post dari view kedalam variabel
        $roles = $this->request->getVar('roles');
        $nama = $this->request->getVar('nama');
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $email = $this->request->getVar('email');
        if($roles == "kaprodi" || $roles == "pembimbing"){
            $id_prodi = $this->request->getVar('id_prodi');
        }else{
            $id_prodi = "";
        }
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO users(id_kelompok, id_prodi, nama, username, password, email, telepon, photo, roles,token_kelompok, status_kelompok, created_at, updated_at) VALUES ('','$id_prodi', '" .$this->db->escapeString($nama). "', '" .$this->db->escapeString($username). "', '" .$this->db->escapeString($password). "', '" .$this->db->escapeString($email). "', '', 'default.png', '" .$this->db->escapeString($roles). "', '', '0', '$now', '$now')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/manage-users'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Data gagal disimpan');
            return redirect()->back()->withInput();
        }
    }

    public function update()
    {
        // validasi
        if (!$this->validate([
            'roles' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'roles harus dipilih'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama harus diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'email harus diisi'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }
        
        // membuat variabel session
        $now = new Time('now');
        // menangkap post dari view kedalam variabel
        $id = $this->request->getVar('id');
        $roles = $this->request->getVar('roles');
        $nama = $this->request->getVar('nama');
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $password_lama = $this->request->getVar('password_lama');
        if($password == $password_lama){
            $password_baru = $password_lama;
        }else{
            $password_baru = md5($this->request->getVar('password'));
        }
        if($roles == "kaprodi" || $roles == "pembimbing"){
            $id_prodi = $this->request->getVar('id_prodi');
        }else{
            $id_prodi = "";
        }
        $update = $this->db->query("UPDATE users SET id_prodi='" .$this->db->escapeString($id_prodi). "', nama='" .$this->db->escapeString($nama). "', username='" .$this->db->escapeString($username). "', password='" .$this->db->escapeString($password). "', email='" .$this->db->escapeString($email). "', roles='" .$this->db->escapeString($roles). "', updated_at='$now' WHERE id_users='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/manage-users'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Update data gagal...!');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "admin"){
            // tampilkan data absen
            $users   = $this->db->query("SELECT * FROM users WHERE id_users='$id' ")->getRowArray();
            // query tampilkan pilihan prodi
            $prodi   = $this->db->query(" SELECT * FROM prodi ")->getResultArray();
            if($users){
                // menampung data kedalam array
                $data = [
                    'users'        => $users,
                    'prodi'        => $prodi,
                ];
                // melempar data ke view
                return view('/admin/users/edit', $data);
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "admin"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM users WHERE id_users='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM users WHERE id_users='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/manage-users'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/manage-users'));
                }
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

}
