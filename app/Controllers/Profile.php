<?php

namespace App\Controllers;

use App\Models\M_users;

class Profile extends BaseController
{
    public function index()
    {
        // membuat variabel id user
        $id_users = session('id_users');
        $roles = session('roles');
        if($roles == "peserta"){
            // query tampilkan data users
            $query   = $this->db->query("SELECT * FROM users WHERE id_users='$id_users' ")->getRowArray();
            // menampung data kedalam array variabel data
            $data = array(
                'users' => $query,
            );
            return view('users/profile/profile', $data);
        }else{
            // query tampilkan data users
            $query   = $this->db->query("SELECT * FROM users WHERE id_users='$id_users' ")->getRowArray();
            // menampung data kedalam array variabel data
            $data = array(
                'users' => $query,
            );
            return view('admin/profile/profile', $data);
        }
    }

    public function update()
    {
        // validasi
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Nama maksimal 50 karakter'
                ]
            ],
            'username' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'max_length' => 'Username maksimal 50 karakter'
                ]
            ],
            'telepon' => [
                'rules' => 'required|numeric|max_length[13]',
                'errors' => [
                    'required' => 'Telepon harus diisi',
                    'numeric' => 'Telepon harus berisi nomor',
                    'max_length' => 'Telepon maksimal 13 karakter'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,500000]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Upload yang hanya tipe gambar'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }

        // panggil model
        $model = new M_users();
        // membuat variabel id user
        $id_users = session('id_users');
        // ambil data yang di post dari view
        $username = $this->request->getVar('username');
        $nama = $this->request->getVar('nama');
        $telepon = $this->request->getVar('telepon');
        $old_password = $this->request->getVar('old_password');
        $new_password = $this->request->getVar('new_password');

        // cek ganti password atau tidak
        $cek_password   = $this->db->query("SELECT id_users, password FROM users WHERE id_users='$id_users' ")->getRowArray();
        if($old_password!=""){
            if(md5($old_password) == $cek_password['password']){
                // jika cocok set variabel password menjadi password baru
                if($new_password!=""){
                    $password   = md5($new_password);
                    $status_password = "baru";
                }else{
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'New Password harus diisi...!');
                    return redirect()->back()->withInput();
                }
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Old Password tidak sesuai...!');
                return redirect()->back()->withInput();
            }
        }else{
            $password   = $cek_password['password'];
            $status_password = "lama";
        }

        // ambil gambar baru dari post view edit
        $file =  $this->request->getFile('gambar');
        // membuat variabel file lama untuk di hapus jika ada upload gambar baru
        $namafilelama =  $this->request->getVar('gambarLama');
        // cek file gambar yang di post apakah ada di post atau tidak
        if($file->getError() == 4) {
            // membuat variabel gambar lama untuk di post kembali jika tidak ada upload gambar baru
            $namafile =  $this->request->getVar('gambarLama');
        } else {
            // ambil nama file baru
            $namafile = $file->getRandomName();
            // pindahkan ke folder public/img/img_kegiatan
            $file->move('img/users', $namafile);
            // cek jika nama fle bukan default maka hapus file
            if($namafilelama != 'default.png') {
                // hapus gambar lama di dalam folder
                unlink('img/users/'.$namafilelama);
            }
        }
        // tampung data kedalam variabel array data
        $data = [
            'username'          => $this->db->escapeString($username),
            'nama'              => $this->db->escapeString($nama),
            'telepon'           => $this->db->escapeString($telepon),
            'password'          => $this->db->escapeString($password),
            'photo'             => $namafile
        ];
        
        // proses insert data ke model/database
        $model->update($id_users ,$data);
        // cek jika database berhasil diubah/ditambah
        if($this->db->affectedRows() > 0) {
            if($status_password=="baru"){
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'success');
                session()->setFlashdata('message', 'Password diperbaharui, silahkan login dengan password baru...');
                return redirect()->to(site_url('/logout'));
            }else{
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'success');
                session()->setFlashdata('message', 'Profil berhasil diperbaharui...');
                return redirect()->to(site_url('/profile'));
            }
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Profil gagal diperbaharui...');
            return redirect()->back()->withInput();
        }

    }
}
