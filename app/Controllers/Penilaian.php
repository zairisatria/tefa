<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Penilaian extends BaseController
{
    public function index()
	{
		// ambil session dan tampung kedalam variabel
		$roles = session('roles');
		$myTime = new Time('now');
		// cek roles akun
		if ($roles=="admin" || $roles=="quality"){
            // proses menampilkan data selain peserta
            // inisialisasi model
            $model = new \App\Models\M_penilaian();
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
            return view('admin/penilaian/penilaian', $data);
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
        if($roles == "admin" || $roles=="quality"){
            // tampilkan data judul proposal
            $produk   = $this->db->query("SELECT a.* FROM proposal AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok INNER JOIN alat AS c ON a.id_kelompok=c.id_kelompok INNER JOIN bahan AS d ON a.id_kelompok=d.id_kelompok INNER JOIN langkah AS e ON a.id_kelompok=e.id_kelompok WHERE a.status_proposal='1' AND a.id_kelompok NOT IN (SELECT id_kelompok FROM penilaian) GROUP BY a.id_kelompok")->getResultArray();
            $data = [
                'produk'        => $produk,
            ];
            return view('admin/penilaian/tambah', $data);
        }else{
            return redirect()->back();
        }
    }

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'id_kelompok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'produk harus dipilih'
                ]
            ],
            'inovasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inovasi harus dipilih'
                ]
            ],
            'bentuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bentuk harus dipilih'
                ]
            ],
            'rasa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rasa harus dipilih'
                ]
            ],
            'kemasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kemasan harus dipilih'
                ]
            ],
            'kelayakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelayakan harus dipilih'
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
        $id_kelompok = $this->request->getVar('id_kelompok');
        $inovasi = $this->request->getVar('inovasi');
        $bentuk = $this->request->getVar('bentuk');
        $rasa = $this->request->getVar('rasa');
        $kemasan = $this->request->getVar('kemasan');
        $kelayakan = $this->request->getVar('kelayakan');
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO penilaian(id_kelompok, inovasi, bentuk, rasa, kemasan, kelayakan,  created_at, updated_at) VALUES ('" .$this->db->escapeString($id_kelompok). "', '" .$this->db->escapeString($inovasi). "', '" .$this->db->escapeString($bentuk). "', '" .$this->db->escapeString($rasa). "', '" .$this->db->escapeString($kemasan). "', '" .$this->db->escapeString($kelayakan). "', '$myTime', '$myTime')");
        // jika query dijalankan
        if($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Data berhasil disimpan');
            return redirect()->to(site_url('/penilaian'));
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
        if($roles == "admin" || $roles=="quality"){
            // tampilkan data absen
            $penilaian   = $this->db->query("SELECT * FROM penilaian WHERE id='$id' ")->getRowArray();
            $produk   = $this->db->query("SELECT a.* FROM proposal AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok INNER JOIN alat AS c ON a.id_kelompok=c.id_kelompok INNER JOIN bahan AS d ON a.id_kelompok=d.id_kelompok INNER JOIN langkah AS e ON a.id_kelompok=e.id_kelompok WHERE a.status_proposal='1' AND a.id_kelompok NOT IN (SELECT id_kelompok FROM penilaian WHERE id != '$id') GROUP BY a.id_kelompok")->getResultArray();
            if($penilaian){
                // menampung data kedalam array
                $data = [
                    'penilaian'        => $penilaian,
                    'produk'           => $produk,
                ];
                // melempar data ke view
                return view('/admin/penilaian/edit', $data);
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
            'id_kelompok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'produk harus dipilih'
                ]
            ],
            'inovasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inovasi harus dipilih'
                ]
            ],
            'bentuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bentuk harus dipilih'
                ]
            ],
            'rasa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rasa harus dipilih'
                ]
            ],
            'kemasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kemasan harus dipilih'
                ]
            ],
            'kelayakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelayakan harus dipilih'
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
        $id_kelompok = $this->request->getVar('id_kelompok');
        $inovasi = $this->request->getVar('inovasi');
        $bentuk = $this->request->getVar('bentuk');
        $rasa = $this->request->getVar('rasa');
        $kemasan = $this->request->getVar('kemasan');
        $kelayakan = $this->request->getVar('kelayakan');
        // jalankan query update
        $update = $this->db->query("UPDATE penilaian SET id_kelompok='" .$this->db->escapeString($id_kelompok). "', inovasi='" .$this->db->escapeString($inovasi). "', bentuk='" .$this->db->escapeString($bentuk). "', rasa='" .$this->db->escapeString($rasa). "', kemasan='" .$this->db->escapeString($kemasan). "', kelayakan='" .$this->db->escapeString($kelayakan). "', updated_at='$myTime' WHERE id='$id' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/penilaian'));
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
        if($roles == "admin" || $roles=="quality"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM penilaian WHERE id='$id' ")->getRowArray();
            if($cek_data){
                // jalankan query delete
                $delete   = $this->db->query("DELETE FROM penilaian WHERE id='$id' ");
                // jika query dijalankan
                if($delete && $this->db->affectedRows() > 0) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/penilaian'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/penilaian'));
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
