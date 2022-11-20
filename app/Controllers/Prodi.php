<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Prodi extends BaseController
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
            $model = new \App\Models\M_prodi();
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
            return view('admin/prodi/prodi', $data);
            // proses manampilkan data admin
			
		}else{
            return redirect()->back();
		}
	}

    public function tambah()
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        // cek roles akun
        if($roles == "admin"){
            return view('admin/prodi/tambah');
        }else{
            return redirect()->back();
        }
    }

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program studi harus diisi'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }
        
        // membuat variabel session
        $myTime = new Time('now');
        // menangkap post dari view kedalam variabel
        $prodi = $this->request->getVar('prodi');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO prodi(prodi, created_at, updated_at) VALUES ('" .$this->db->escapeString($prodi). "', '$myTime', '$myTime')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/prodi'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Data gagal disimpan');
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
            $prodi   = $this->db->query("SELECT * FROM prodi WHERE id='$id' ")->getRowArray();
            if($prodi){
                // menampung data kedalam array
                $data = [
                    'prodi'        => $prodi,
                ];
                // melempar data ke view
                return view('/admin/prodi/edit', $data);
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function update()
    {
        // validasi
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program studi harus diisi'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }

        // membuat variabel id user
        $myTime = new Time('now');
        // menangkap post dari view
        $id = $this->request->getVar('id');
        $prodi = $this->request->getVar('prodi');
        $id_users_kaprodi = $this->request->getVar('id_users_kaprodi');
        // jalankan query update
        $update = $this->db->query("UPDATE prodi SET prodi='" .$this->db->escapeString($prodi). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/prodi'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Update data gagal...!');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "admin"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM prodi WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM prodi WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/prodi'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/prodi'));
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
