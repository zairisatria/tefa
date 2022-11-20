<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Distribusi extends BaseController
{
    public function index()
	{
		// ambil session dan tampung kedalam variabel
		$roles = session('roles');
		$myTime = new Time('now');
		// cek roles akun
		if ($roles=="admin" || $roles=="pemasaran"){
            // proses menampilkan data selain peserta
            // inisialisasi model
            $model = new \App\Models\M_distribusi();
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
                'keyword'               => $keyword,
            ];
            return view('admin/distribusi/distribusi', $data);
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
        if($roles == "admin" || $roles=="pemasaran"){
            // tampilkan data judul proposal
            $produk   = $this->db->query("SELECT a.* FROM proposal AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok INNER JOIN alat AS c ON a.id_kelompok=c.id_kelompok INNER JOIN bahan AS d ON a.id_kelompok=d.id_kelompok INNER JOIN langkah AS e ON a.id_kelompok=e.id_kelompok INNER JOIN penilaian AS f ON a.id_kelompok=f.id_kelompok WHERE a.status_proposal='1' AND a.id NOT IN (SELECT id_proposal FROM distribusi) GROUP BY a.id_kelompok")->getResultArray();
            $toko   = $this->db->query("SELECT * FROM toko ORDER BY id DESC")->getResultArray();
            $data = [
                'produk'        => $produk,
                'toko'        => $toko,
            ];
            return view('admin/distribusi/tambah', $data);
        }else{
            return redirect()->back();
        }
    }

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'id_proposal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'produk harus dipilih'
                ]
            ],
            'id_toko' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'toko harus dipilih'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga jual harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus diisi'
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
        $id_proposal = $this->request->getVar('id_proposal');
        $id_toko = $this->request->getVar('id_toko');
        $harga_jual = $this->request->getVar('harga_jual');
        $jumlah = $this->request->getVar('jumlah');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO distribusi(id_proposal, id_toko, harga_jual, jumlah, created_at, updated_at) VALUES ('" .$this->db->escapeString($id_proposal). "', '" .$this->db->escapeString($id_toko). "', '" .$this->db->escapeString($harga_jual). "', '" .$this->db->escapeString($jumlah). "', '$now', '$now')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/distribusi'));
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
        if($roles == "admin" || $roles=="pemasaran"){
            // tampilkan data absen
            $distribusi   = $this->db->query("SELECT * FROM distribusi WHERE id='$id' ")->getRowArray();
            $produk   = $this->db->query("SELECT a.* FROM proposal AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok INNER JOIN alat AS c ON a.id_kelompok=c.id_kelompok INNER JOIN bahan AS d ON a.id_kelompok=d.id_kelompok INNER JOIN langkah AS e ON a.id_kelompok=e.id_kelompok INNER JOIN penilaian AS f ON a.id_kelompok=f.id_kelompok WHERE a.status_proposal='1' AND a.id NOT IN (SELECT id_proposal FROM distribusi WHERE id != '$id') GROUP BY a.id_kelompok")->getResultArray();
            $toko   = $this->db->query("SELECT * FROM toko ORDER BY id DESC")->getResultArray();
            if($distribusi){
                // menampung data kedalam array
                $data = [
                    'distribusi'        => $distribusi,
                    'produk'           => $produk,
                    'toko'           => $toko,
                ];
                // melempar data ke view
                return view('/admin/distribusi/edit', $data);
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
            'id_proposal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'produk harus dipilih'
                ]
            ],
            'id_toko' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'toko harus dipilih'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga jual harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah harus diisi'
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
        $id_proposal = $this->request->getVar('id_proposal');
        $id_toko = $this->request->getVar('id_toko');
        $harga_jual = $this->request->getVar('harga_jual');
        $jumlah = $this->request->getVar('jumlah');
        // jalankan query update
        $update = $this->db->query("UPDATE distribusi SET id_proposal='" .$this->db->escapeString($id_proposal). "', id_toko='" .$this->db->escapeString($id_toko). "', harga_jual='" .$this->db->escapeString($harga_jual). "', jumlah='" .$this->db->escapeString($jumlah). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/distribusi'));
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
        if($roles == "admin" || $roles=="pemasaran"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM distribusi WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM distribusi WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/distribusi'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/distribusi'));
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
