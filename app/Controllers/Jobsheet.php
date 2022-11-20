<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Jobsheet extends BaseController
{
    public function index()
	{
		// ambil session dan tampung kedalam variabel
		$id_users = session('id_users');
		$id_kelompok = session('id_kelompok');
		$roles = session('roles');
		$myTime = new Time('now');

		// cek roles akun
		if ($roles=="peserta"){
            // jika ada proposal yang disetujui
            // inisialisasi model
            $model_alat = new \App\Models\M_alat();
            $model_bahan = new \App\Models\M_bahan();
            $model_langkah = new \App\Models\M_langkah();
            // membuat perulangan nomor no++ dengan mengambil nilai url pagination
            $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1 ;
            // variabel jumlah data yang ditampilkan dalam pagination
            $jumlah_baris_data = 5;
            // sett model kedalam variabel
            $cari_data_alat = $model_alat->tampil_data_user();
            $cari_data_bahan = $model_bahan->tampil_data_user();
            $cari_data_langkah = $model_langkah->tampil_data_user();
            // menampung data kedalam variabel array untuk ditampilan ke view
            $data = [
                'data_pagination_alat'      => $cari_data_alat->paginate($jumlah_baris_data, 'default'),
                'data_pagination_bahan'     => $cari_data_bahan->paginate($jumlah_baris_data, 'default'),
                'data_pagination_langkah'   => $cari_data_langkah->paginate($jumlah_baris_data, 'default'),
                'pager_alat'                => $cari_data_alat->tampil_data_user()->pager,
                'pager_bahan'               => $cari_data_bahan->tampil_data_user()->pager,
                'pager_langkah'             => $cari_data_langkah->tampil_data_user()->pager,
                'currentPage'               => $currentPage,
                'jumlah_baris_data'         => $jumlah_baris_data,
            ];
            return view('users/jobsheet/jobsheet', $data);
		}else{
            // inisialisasi model
            $model = new \App\Models\M_Jobsheet();
            // membuat perulangan nomor no++ dengan mengambil nilai url pagination
            $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1 ;
            // variabel jumlah data yang ditampilkan dalam pagination
            $jumlah_baris_data = 5;
            // menangkap data pencarian
            $keyword = $this->request->getVar('keyword');
            // kondisi jika ada pencarian atau tidak
            if($keyword){
                $cari_data_diterima = $model->pencarian_admin($keyword);
            } else {
                $cari_data_diterima = $model->tampil_data_admin();
            };

            $data = [
                'data_pagination_diterima'  => $cari_data_diterima->paginate($jumlah_baris_data, 'default'),
                'pager_diterima'            => $cari_data_diterima->tampil_data_admin()->pager,
                'currentPage'               => $currentPage,
                'jumlah_baris_data'         => $jumlah_baris_data,
                'keyword'                   => $keyword,
            ];
			return view('admin/jobsheet/jobsheet', $data);
		}
	}

    public function detail_alat($id_kelompok)
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        // cek roles akun
        if($roles == "admin"){
            // tampilkan data alat
            $alat   = $this->db->query("SELECT * FROM alat WHERE id_kelompok='$id_kelompok' ORDER BY id DESC ")->getResultArray();
            $data = [
                'alat'                  => $alat,
            ];
            return view('admin/jobsheet/detail_alat', $data);
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function detail_bahan($id_kelompok)
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        // cek roles akun
        if($roles == "admin"){
            // tampilkan data alat
            $bahan   = $this->db->query("SELECT * FROM bahan WHERE id_kelompok='$id_kelompok' ORDER BY id DESC ")->getResultArray();
            $total_bahan   = $this->db->query("SELECT SUM(harga*jumlah) AS total_bahan FROM bahan WHERE id_kelompok='$id_kelompok' ")->getRowArray();
            $data = [
                'bahan'                  => $bahan,
                'total_bahan'            => $total_bahan,
            ];
            return view('admin/jobsheet/detail_bahan', $data);
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function detail_langkah($id_kelompok)
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        // cek roles akun
        if($roles == "admin"){
            // tampilkan data alat
            $langkah   = $this->db->query("SELECT * FROM langkah WHERE id_kelompok='$id_kelompok' ORDER BY id DESC ")->getResultArray();
            $data = [
                'langkah'                  => $langkah,
            ];
            return view('admin/jobsheet/detail_langkah', $data);
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function tambah_alat()
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek roles akun
        if($roles == "peserta"){
            // cek apakah sudah ada proposal yang disetujui / sudah dapat pembimbing
            $cek_pembimbing   = $this->db->query("SELECT * FROM map_pembimbing WHERE id_kelompok='$id_kelompok' ")->getRow();
            if($cek_pembimbing){
                 // jika ada proposal yang disetujui / sudah dapat pembimbing
                return view('users/jobsheet/tambah_alat');
            }else{
                // jika proposal tidak ada yang disetujui / belum dapat pembimbing
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Anda belum memiliki pembimbing');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function simpan_alat()
    {
        // validasi
        if (!$this->validate([
            'alat' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Alat harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required'  => 'Jumlah alat harus diisi',
                    'numeric'   => 'Jumlah harus berisi angka',
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }
        
        // membuat variabel session
        $id_users = session('id_users');
        $id_kelompok = session('id_kelompok');
        $myTime = new Time('now');
        // menangkap post dari view kedalam variabel
        $alat = $this->request->getVar('alat');
        $jumlah = $this->request->getVar('jumlah');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO alat(id_kelompok, alat, jumlah, created_at, updated_at) VALUES ('$id_kelompok', '" .$this->db->escapeString($alat). "', '" .$this->db->escapeString($jumlah). "', '$myTime', '$myTime')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/jobsheet'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Data gagal disimpan');
            return redirect()->back()->withInput();
        }
    }

    public function edit_alat($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $alat   = $this->db->query("SELECT * FROM alat WHERE id='$id' ")->getRowArray();
            if($alat){
                // menampung data kedalam array
                $data = [
                    'alat'        => $alat,
                ];
                // melempar data ke view
                return view('/users/jobsheet/edit_alat', $data);
            }else{
                // jika url tidak valid
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function update_alat()
    {
        // validasi
        if (!$this->validate([
            'alat' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Alat harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required'  => 'Jumlah alat harus diisi',
                    'numeric'   => 'Jumlah harus berisi angka',
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
        $alat = $this->request->getVar('alat');
        $jumlah = $this->request->getVar('jumlah');
        // jalankan query update
        $update = $this->db->query("UPDATE alat SET alat='" .$this->db->escapeString($alat). "', jumlah='" .$this->db->escapeString($jumlah). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/jobsheet'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Update data gagal...!');
            return redirect()->back()->withInput();
        }
    }

    public function delete_alat($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM alat WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM alat WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/jobsheet'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/jobsheet'));
                }
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function tambah_bahan()
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek roles akun
        if($roles == "peserta"){
            // cek apakah sudah ada proposal yang disetujui / sudah dapat pembimbing
            $cek_pembimbing   = $this->db->query("SELECT * FROM map_pembimbing WHERE id_kelompok='$id_kelompok' ")->getRow();
            if($cek_pembimbing){
                $satuan   = $this->db->query("SELECT * FROM m_satuan ")->getResultArray();
                $data = [
                    'satuan'        => $satuan,
                ];
                // jika ada proposal yang disetujui / sudah dapat pembimbing
                return view('users/jobsheet/tambah_bahan', $data);
            }else{
                // jika proposal tidak ada yang disetujui / belum dapat pembimbing
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Anda belum memiliki pembimbing');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function simpan_bahan()
    {
        // validasi
        if (!$this->validate([
            'bahan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Bahan harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required'  => 'Harga alat harus diisi',
                    'numeric'   => 'Harga harus berisi angka',
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required'  => 'Jumlah alat harus diisi',
                    'numeric'   => 'Jumlah harus berisi angka',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'Satuan bahan harus diisi',
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }
        
        // membuat variabel session
        $id_users = session('id_users');
        $id_kelompok = session('id_kelompok');
        $myTime = new Time('now');
        // menangkap post dari view kedalam variabel
        $bahan = $this->request->getVar('bahan');
        $harga = $this->request->getVar('harga');
        $jumlah = $this->request->getVar('jumlah');
        $satuan = $this->request->getVar('satuan');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO bahan(id_kelompok, bahan, harga, jumlah, satuan, created_at, updated_at) VALUES ('$id_kelompok', '" .$this->db->escapeString($bahan). "', '" .$this->db->escapeString($harga). "', '" .$this->db->escapeString($jumlah). "', '" .$this->db->escapeString($satuan). "', '$myTime', '$myTime')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/jobsheet'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Data gagal disimpan');
            return redirect()->back()->withInput();
        }
    }

    public function edit_bahan($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $bahan   = $this->db->query("SELECT * FROM bahan WHERE id='$id' ")->getRowArray();
            $satuan   = $this->db->query("SELECT * FROM m_satuan ")->getResultArray();
            if($bahan){
                // menampung data kedalam array
                $data = [
                    'bahan'         => $bahan,
                    'satuan'        => $satuan,
                ];
                // melempar data ke view
                return view('/users/jobsheet/edit_bahan', $data);
            }else{
                // jika url tidak valid
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function update_bahan()
    {
        // validasi
        if (!$this->validate([
            'bahan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Bahan harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required'  => 'Harga alat harus diisi',
                    'numeric'   => 'Harga harus berisi angka',
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required'  => 'Jumlah alat harus diisi',
                    'numeric'   => 'Jumlah harus berisi angka',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'Satuan bahan harus diisi',
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
        $bahan = $this->request->getVar('bahan');
        $harga = $this->request->getVar('harga');
        $jumlah = $this->request->getVar('jumlah');
        $satuan = $this->request->getVar('satuan');
        // jalankan query update
        $update = $this->db->query("UPDATE bahan SET bahan='" .$this->db->escapeString($bahan). "', harga='" .$this->db->escapeString($harga). "', jumlah='" .$this->db->escapeString($jumlah). "', satuan='" .$this->db->escapeString($satuan). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/jobsheet'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Update data gagal...!');
            return redirect()->back()->withInput();
        }
    }

    public function delete_bahan($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM bahan WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM bahan WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/jobsheet'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/jobsheet'));
                }
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function tambah_langkah()
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek roles akun
        if($roles == "peserta"){
            // cek apakah sudah ada proposal yang disetujui / sudah dapat pembimbing
            $cek_pembimbing   = $this->db->query("SELECT * FROM map_pembimbing WHERE id_kelompok='$id_kelompok' ")->getRow();
            if($cek_pembimbing){
                // jika ada proposal yang disetujui / sudah dapat pembimbing
                return view('users/jobsheet/tambah_langkah');
            }else{
                // jika proposal tidak ada yang disetujui / belum dapat pembimbing
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Anda belum memiliki pembimbing');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function simpan_langkah()
    {
        // validasi
        if (!$this->validate([
            'langkah' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Langkah harus diisi'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }
        
        // membuat variabel session
        $id_users = session('id_users');
        $id_kelompok = session('id_kelompok');
        $myTime = new Time('now');
        // menangkap post dari view kedalam variabel
        $langkah = $this->request->getVar('langkah');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO langkah(id_kelompok, langkah, created_at, updated_at) VALUES ('$id_kelompok', '" .$this->db->escapeString($langkah). "', '$myTime', '$myTime')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/jobsheet'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Data gagal disimpan');
            return redirect()->back()->withInput();
        }
    }

    public function edit_langkah($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $langkah   = $this->db->query("SELECT * FROM langkah WHERE id='$id' ")->getRowArray();
            if($langkah){
                // menampung data kedalam array
                $data = [
                    'langkah'        => $langkah,
                ];
                // melempar data ke view
                return view('/users/jobsheet/edit_langkah', $data);
            }else{
                // jika url tidak valid
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function update_langkah()
    {
        // validasi
        if (!$this->validate([
            'langkah' => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Langkah harus diisi'
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
        $langkah = $this->request->getVar('langkah');
        // jalankan query update
        $update = $this->db->query("UPDATE langkah SET langkah='" .$this->db->escapeString($langkah). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/jobsheet'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Update data gagal...!');
            return redirect()->back()->withInput();
        }
    }

    public function delete_langkah($id)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM langkah WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM langkah WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/jobsheet'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/jobsheet'));
                }
            }else{
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data tidak ditemukan');
                return redirect()->back();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function print_jobsheet_pdf()
    {
        // ambil session
        $roles = session('roles');
		$id_users = session('id_users');
		$id_kelompok = session('id_kelompok');
        // variabel waktu sekarang
        $myTime = new Time('now');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan judul proposal
            $proposal   = $this->db->query("SELECT * FROM proposal WHERE id_kelompok='$id_kelompok' AND status_proposal='1' ")->getResultArray();
            // tampilkan data alat
            $alat   = $this->db->query("SELECT * FROM alat WHERE id_kelompok='$id_kelompok' ORDER BY id DESC")->getResultArray();
            // tampilkan data bahan
            $bahan   = $this->db->query("SELECT * FROM bahan WHERE id_kelompok='$id_kelompok' ORDER BY id DESC")->getResultArray();
            $total_bahan   = $this->db->query("SELECT SUM(harga*jumlah) AS total_bahan FROM bahan WHERE id_kelompok='$id_kelompok' ")->getRowArray();
            // tampilkan data langkah kerja
            $langkah   = $this->db->query("SELECT * FROM langkah WHERE id_kelompok='$id_kelompok' ORDER BY id DESC")->getResultArray();
            // tampilkan data yang diquery
            $data = [
            'proposal'          => $proposal,
            'alat'    	        => $alat,
            'bahan'    	        => $bahan,
            'total_bahan'    	=> $total_bahan,
            'langkah'           => $langkah,
            ];

            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
            $mpdf->showImageErrors = true;
            $html = view('users/jobsheet/lap_jobsheet_pdf', $data);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle("Jobsheet");
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            //    $mpdf->WriteHTML('<h1>Hello world!</h1>');
            $this->response->setContentType('application/pdf');
            $mpdf->Output('Jobsheet.pdf','I');
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function print_jobsheet_pdf_admin($id_kelompok)
    {
        // ambil session
        $roles = session('roles');
        // variabel waktu sekarang
        $myTime = new Time('now');
        if($roles == "admin"){
            // tampilkan judul proposal
            $proposal   = $this->db->query("SELECT * FROM proposal WHERE id_kelompok='$id_kelompok' AND status_proposal='1' ")->getResultArray();
            // tampilkan data alat
            $alat   = $this->db->query("SELECT * FROM alat WHERE id_kelompok='$id_kelompok' ORDER BY id DESC")->getResultArray();
            // tampilkan data bahan
            $bahan   = $this->db->query("SELECT * FROM bahan WHERE id_kelompok='$id_kelompok' ORDER BY id DESC")->getResultArray();
            $total_bahan   = $this->db->query("SELECT SUM(harga*jumlah) AS total_bahan FROM bahan WHERE id_kelompok='$id_kelompok' ")->getRowArray();
            // tampilkan data langkah kerja
            $langkah   = $this->db->query("SELECT * FROM langkah WHERE id_kelompok='$id_kelompok' ORDER BY id DESC")->getResultArray();
            // tampilkan data yang diquery
            $data = [
            'proposal'          => $proposal,
            'alat'    	        => $alat,
            'bahan'    	        => $bahan,
            'total_bahan'    	=> $total_bahan,
            'langkah'           => $langkah,
            ];

            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
            $mpdf->showImageErrors = true;
            $html = view('admin/jobsheet/lap_jobsheet_pdf', $data);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle("Jobsheet");
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            //    $mpdf->WriteHTML('<h1>Hello world!</h1>');
            $this->response->setContentType('application/pdf');
            $mpdf->Output('Jobsheet.pdf','I');
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

}
