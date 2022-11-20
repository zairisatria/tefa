<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Satuan extends BaseController
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
            $model = new \App\Models\M_satuan();
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
            return view('admin/satuan/satuan', $data);
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
            return view('admin/satuan/tambah');
        }else{
            return redirect()->back();
        }
    }

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'satuan harus diisi'
                ]
            ],
            'konversi_satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'konversi satuan harus diisi'
                ]
            ],
            'nilai_konversi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nilai konversi harus diisi'
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
        $satuan = $this->request->getVar('satuan');
        $konversi_satuan = $this->request->getVar('konversi_satuan');
        $nilai_konversi = $this->request->getVar('nilai_konversi');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO m_satuan(satuan, konversi_satuan, nilai_konversi, created_at, updated_at) VALUES ('" .$this->db->escapeString($satuan). "', '" .$this->db->escapeString($konversi_satuan). "', '" .$this->db->escapeString($nilai_konversi). "', '$myTime', '$myTime')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/satuan'));
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
            $satuan   = $this->db->query("SELECT * FROM m_satuan WHERE id='$id' ")->getRowArray();
            if($satuan){
                // menampung data kedalam array
                $data = [
                    'satuan'        => $satuan,
                ];
                // melempar data ke view
                return view('/admin/satuan/edit', $data);
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
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'satuan harus diisi'
                ]
            ],
            'konversi_satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'konversi satuan harus diisi'
                ]
            ],
            'nilai_konversi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nilai konversi harus diisi'
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
        $satuan = $this->request->getVar('satuan');
        $konversi_satuan = $this->request->getVar('konversi_satuan');
        $nilai_konversi = $this->request->getVar('nilai_konversi');
        // jalankan query update
        $update = $this->db->query("UPDATE m_satuan SET satuan='" .$this->db->escapeString($satuan). "', konversi_satuan='" .$this->db->escapeString($konversi_satuan). "', nilai_konversi='" .$this->db->escapeString($nilai_konversi). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/satuan'));
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
            $cek_data   = $this->db->query("SELECT * FROM m_satuan WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM m_satuan WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/satuan'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/satuan'));
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
