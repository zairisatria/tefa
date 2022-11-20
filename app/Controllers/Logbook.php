<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Helpers\ConvertTglIndo;

class Logbook extends BaseController
{
    public function index()
    {
        // ambil session
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek role akses
        if($roles == "peserta"){
            // inisialisasi model
            $model = new \App\Models\M_logbook();
            // membuat perulangan nomor no++ dengan mengambil nilai url pagination
            $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1 ;
            // variabel jumlah data yang ditampilkan dalam pagination
            $jumlah_baris_data = 5;
            
            // menangkap data pencarian
            $from = $this->request->getVar('from');
            $to = $this->request->getVar('to');
            if($from || $to){
                $cari_data = $model->pencarian($from, $to);
            } else {
                $cari_data = $model->tampil_data();
            };
            // menampung data kedalam variabel array
            $data = [
                'data_pagination'       => $cari_data->paginate($jumlah_baris_data, 'default'),
                'pager'                 => $cari_data->tampil_data()->pager,
                'currentPage'           => $currentPage,
                'jumlah_baris_data'     => $jumlah_baris_data,
                'from'                  => $from,
                'to'                    => $to,
            ];
            return view('users/logbook/logbook', $data);
        }else{
            // inisialisasi model
            $model = new \App\Models\M_logbook();
            // membuat perulangan nomor no++ dengan mengambil nilai url pagination
            $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1 ;
            // variabel jumlah data yang ditampilkan dalam pagination
            $jumlah_baris_data = 5;
            // menangkap data pencarian
            $keyword = $this->request->getVar('keyword');
            // kondisi jika ada pencarian atau tidak
            if($keyword){
                $cari_data = $model->pencarian_admin_diterima($keyword);
            } else {
                $cari_data = $model->tampil_data_admin_diterima();
            };

            $data = [
                'data_pagination_diterima'  => $cari_data->paginate($jumlah_baris_data, 'default'),
                'pager_diterima'            => $cari_data->tampil_data_admin_diterima()->pager,
                'currentPage'               => $currentPage,
                'jumlah_baris_data'         => $jumlah_baris_data,
                'keyword'                   => $keyword,
            ];
			return view('admin/logbook/logbook', $data);
        }
    }

    public function tambah()
    {
        // ambil session
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek role akses
        if($roles == "peserta"){
            // cek apakah sudah ada proposal yang disetujui / sudah dapat pembimbing
            $cek_pembimbing   = $this->db->query("SELECT * FROM map_pembimbing WHERE id_kelompok='$id_kelompok' ")->getRow();
            if($cek_pembimbing){
                // buat kode unik untuk menghubungkan antara header dan detail
                $uuid = $this->db->query("SELECT NOW()+0 AS uuid ")->getRowArray();
                // menampung data kedalam variabel array
                $data = [
                    'uuid'                    => $uuid,
                ];
                // jika ada proposal yang disetujui / sudah dapat pembimbing
                return view('users/logbook/tambah', $data);
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

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi',
                ]
            ],
            'dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu dari harus diisi',
                ]
            ],
            'sampai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu sampai harus diisi',
                ]
            ],
            'aktivitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Aktivitas harus diisi'
                ]
            ],
            'keluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keluaran harus diisi'
                ]
            ],
            'jenis_aktifitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis aktifitas harus dipilih'
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
        // menangkap post dari view
        $uuid = $this->request->getVar('uuid');
        $date = $this->request->getVar('date');
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $aktivitas = $this->request->getVar('aktivitas');
        $keluaran = $this->request->getVar('keluaran');
        $jenis_aktifitas = $this->request->getVar('jenis_aktifitas');
        // sebelum insert data cek dulu apakah inputan jam dari atau jam sampainya sudah ada dalam rentang waktu inputan
        $validasi_data   = $this->db->query("SELECT * FROM logbook WHERE (id_users='$id_users' AND date='$date') AND (('$dari' >= dari AND '$dari' <= sampai) OR ('$sampai' >= dari AND '$sampai' <= sampai)) ")->getRowArray();
        if($validasi_data){
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Waktu dari/sampai sudah termasuk dalam inputan sebelumnya..!');
            return redirect()->back()->withInput();
        }else{
            // proses insert ke tabel logbook
            $insert = $this->db->query("INSERT INTO logbook(uuid, id_kelompok, id_users, date, dari, sampai, aktivitas, keluaran, jenis_aktifitas, created_at, updated_at) VALUES ('$uuid', '$id_kelompok', '$id_users', '$date', '$dari', '$sampai', '" .$this->db->escapeString($aktivitas). "', '" .$this->db->escapeString($keluaran). "', '$jenis_aktifitas', '$myTime', '$myTime')");
            if($insert){
                $file =  $_FILES['files'];
                $namafile = $_FILES['files']['name'];
                $uploads_dir = 'files/logbook_dokumentasi';
                // dd($file);
                // proses insert ke tabel logbook_dokumentasi
                    // pindahkan ke folder
                    foreach ($_FILES["files"]["error"] as $key => $error) {
                        if ($error == UPLOAD_ERR_OK) {
                            $tmp_name = $_FILES["files"]["tmp_name"][$key];
                            $name = basename($_FILES["files"]["name"][$key]);
                            $newname = rand().$name;
                            move_uploaded_file($tmp_name, "$uploads_dir/$newname");
                            $insert_dokumentasi = $this->db->query("INSERT INTO d_logbook(uuid, id_kelompok, files, created_at, updated_at) VALUES ('$uuid', '$id_kelompok', '$newname', '$myTime', '$myTime')");
                        }
                    }
            }
            // jika query dijalankan
            if($insert && $this->db->affectedRows() > 0) {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'success');
                session()->setFlashdata('message', 'Data berhasil disimpan..');
                return redirect()->to(site_url('/logbook'));
            } else {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data gagal disimpan..');
                return redirect()->back()->withInput();
            }
        }
    }

    public function edit($uuid)
    {
        // ambil session
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek data kepemilikan
        if($roles == "peserta"){
            // ambil session
            $id_users = session('id_users');
            // melakukan query berdasarkan id yang di post
            $validasi_data   = $this->db->query("SELECT id FROM logbook WHERE id_users='$id_users' AND uuid='$uuid' ")->getRowArray();
            // jika id tidak ada di database tampilkan error not found
            if($validasi_data > 0) {
                // tampilkan data
                $logbook   = $this->db->query("SELECT * FROM logbook WHERE id_kelompok='$id_kelompok' AND uuid='$uuid' ")->getRowArray();
                $d_logbook   = $this->db->query("SELECT * FROM d_logbook WHERE id_kelompok='$id_kelompok' AND uuid='$uuid' ")->getResultArray();
                // menampung data kedalam array
                $data = [
                    'logbook'                    => $logbook,
                    'd_logbook'                  => $d_logbook,
                ];
                // melempar data ke view
                return view('/users/logbook/edit', $data);
            } else {
                // menampilkan error not found
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
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

    public function update()
    {
        // validasi
        if (!$this->validate([
            'date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi',
                ]
            ],
            'dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu dari harus diisi',
                ]
            ],
            'sampai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu sampai harus diisi',
                ]
            ],
            'aktivitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Aktivitas harus diisi'
                ]
            ],
            'keluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keluaran harus diisi'
                ]
            ],
            'jenis_aktifitas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis aktifitas harus dipilih'
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
        // menangkap post dari view
        $uuid = $this->request->getVar('uuid');
        $date = $this->request->getVar('date');
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $dari_lama = $this->request->getVar('dari_lama');
        $sampai_lama = $this->request->getVar('sampai_lama');
        $aktivitas = $this->request->getVar('aktivitas');
        $keluaran = $this->request->getVar('keluaran');
        $jenis_aktifitas = $this->request->getVar('jenis_aktifitas');
        // cek dapakah jam dari dan sampainya sama
        // sebelum insert data cek dulu apakah inputan jam dari atau jam sampainya sudah ada dalam rentang waktu inputan
        $validasi_data   = $this->db->query("SELECT * FROM logbook WHERE uuid != $uuid AND (id_users='$id_users' AND date='$date') AND (('$dari' >= dari AND '$dari' <= sampai) OR ('$sampai' >= dari AND '$sampai' <= sampai)) ")->getRowArray();
        if($validasi_data){
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Waktu dari/sampai sudah termasuk dalam inputan sebelumnya..!');
            return redirect()->back()->withInput();
        }else{
            // proses insert ke tabel logbook
            $update_header = $this->db->query("UPDATE logbook SET date='$date', dari='$dari', sampai='$sampai' , aktivitas='$aktivitas', keluaran='$keluaran', jenis_aktifitas='$jenis_aktifitas', updated_at='$myTime' ");
            
            $uploads_dir = 'files/logbook_dokumentasi';
            // dd($file);
            // proses insert ke tabel logbook_dokumentasi
                // pindahkan ke folder
                foreach ($_FILES["files"]["error"] as $key => $error) {
                    $d_id = $_POST['d_id'][$key];
                    $tmp_name = $_FILES["files"]["tmp_name"][$key];
                    $name = basename($_FILES["files"]["name"][$key]);
                    $newname = rand().$name;
                    // cek apakah ada file nya
                    if($name){
                        //mengecek data yang nilai 0 di insert, selain 0 diupdate
                        if($d_id == '0' && $_FILES["files"]["error"]) {
                            move_uploaded_file($tmp_name, "$uploads_dir/$newname");
                            $insert_detail = $this->db->query("INSERT INTO d_logbook(uuid, id_kelompok, files, created_at, updated_at) VALUES ('$uuid', '$id_kelompok', '$newname', '$myTime', '$myTime')");
                        }else{
                            $update_header = $this->db->query("UPDATE d_logbook SET files='$newname', updated_at='$myTime' WHERE id='$d_id'");
                        }
                    }
    
                }
                
            //menghapus data sesuai baris yang dihapus
            if(isset($_POST['id_hapus_x'])) {
                $jumlah_dihapus = count($_POST['id_hapus_x']);
                for($indexke=0; $indexke < $jumlah_dihapus; $indexke++) {
                    $idnya = $_POST['id_hapus_x'][$indexke];
                    $filenya = $_POST['file_hapus'][$indexke];
                    unlink('files/logbook_dokumentasi/'.$filenya);
                    $hapus_detail = $this->db->query("DELETE FROM d_logbook WHERE id='$idnya' ");
                }
            }
            // jika query dijalankan
            if($update_header || $update_header || $insert_detail || $hapus_detail) {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'success');
                session()->setFlashdata('message', 'Data berhasil disimpan..');
                return redirect()->to(site_url('/logbook'));
            } else {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Data gagal disimpan..');
                return redirect()->back()->withInput();
            }
        }
    }

    public function detail_users($uuid)
    {
        // ambil session
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data
            $d_logbook   = $this->db->query("SELECT b.*, CASE WHEN b.files LIKE '%mp4%' OR b.files LIKE '%mpeg%' OR b.files LIKE '%webm%' THEN 'video' ELSE 'gambar' END AS format_files FROM logbook AS a INNER JOIN d_logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid WHERE b.id_kelompok='$id_kelompok' AND b.uuid='$uuid' ORDER BY b.id ASC ")->getResultArray();
            if($d_logbook){
                // menampung data kedalam variabel array
                $data = [
                    'd_logbook'                  => $d_logbook,
                ];
                return view('users/logbook/detail', $data);
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

    public function detail_admin($id_kelompok)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "admin"){
            // tampilkan data
            $d_logbook   = $this->db->query("SELECT b.*, c.nama, CASE WHEN b.files LIKE '%mp4%' OR b.files LIKE '%mpeg%' OR b.files LIKE '%webm%' THEN 'video' ELSE 'gambar' END AS format_files FROM logbook AS a INNER JOIN d_logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid INNER JOIN users AS c ON a.id_users=c.id_users AND a.id_kelompok=c.id_kelompok WHERE b.id_kelompok='$id_kelompok' ORDER BY b.id ASC ")->getResultArray();
            if($d_logbook){
                // menampung data kedalam variabel array
                $data = [
                    'd_logbook'                  => $d_logbook,
                ];
                return view('admin/logbook/detail', $data);
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

    public function delete($uuid)
    {
        // ambil session
        $roles = session('roles');
        // cek data kepemilikan
        if($roles == "peserta"){
            // tampilkan data absen
            $cek_data   = $this->db->query("SELECT * FROM logbook WHERE uuid='$uuid' ")->getRowArray();
            if($cek_data){
                $d_logbook   = $this->db->query("SELECT * FROM d_logbook WHERE uuid='$uuid' ")->getResultArray();
                foreach ($d_logbook as $key) {
                    $file = $key["files"];
                    unlink('files/logbook_dokumentasi/'.$file);
                }
                // jalankan query delete
                $delete_header   = $this->db->query("DELETE FROM logbook WHERE uuid='$uuid' ");
                $delete_detail   = $this->db->query("DELETE FROM d_logbook WHERE uuid='$uuid' ");
                // jika query dijalankan
                if($delete_header || $delete_detail) {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'success');
                    session()->setFlashdata('message', 'Data berhasil dihapus');
                    return redirect()->to(site_url('/logbook'));
                } else {
                    // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                    session()->setFlashdata('flashdata', 'error');
                    session()->setFlashdata('message', 'Data gagal dihapus');
                    return redirect()->to(site_url('/logbook'));
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


    public function print_logbook_pdf()
    {
        // Inisialisasi Helper
        $TglIndo = new ConvertTglIndo();
        // membuat variabel dari session
		$roles = session('roles');
		$id_users = session('id_users');
		$id_kelompok = session('id_kelompok');
        // variabel waktu sekarang
        $myTime = new Time('now');
		// menangkap parameter
		$from = $this->request->getVar('from');
		$to = $this->request->getVar('to');
        if($roles == "peserta"){
            // menampilkan nama kelompok
            $proposal   = $this->db->query("SELECT * FROM proposal WHERE status_proposal='1' AND id_kelompok='$id_kelompok' ")->getRowArray();
            // tampilkan data absen sesuai parameter
            $logbook   = $this->db->query("SELECT a.*, b.nama FROM logbook AS a INNER JOIN users AS b ON a.id_users=b.id_users AND a.id_kelompok=b.id_kelompok WHERE (a.date BETWEEN '$from' AND '$to') AND a.id_users = '$id_users' AND a.id_kelompok='$id_kelompok' ")->getResultArray();
            $d_logbook   = $this->db->query("SELECT * FROM d_logbook AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid WHERE (a.files NOT LIKE '%.mp4%' AND a.files NOT LIKE '%.mpeg%' AND a.files NOT LIKE '%webm%') AND b.id_users = '$id_users' AND b.id_kelompok='$id_kelompok' ")->getResultArray();
            // tampilkan data yang diquery
            $dataArray = [
            'TglIndo'           => $TglIndo,
            'logbook'    	    => $logbook,
            'd_logbook'    	    => $d_logbook,
            'proposal'          => $proposal,
            'from'     		    => $from,
            'to'     		    => $to,
            ];

            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
            $html = view('users/logbook/lap_logbook_pdf', $dataArray);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle("Log Book");
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            $mpdf->showImageErrors = true;
            //    $mpdf->WriteHTML('<h1>Hello world!</h1>');
            $this->response->setContentType('application/pdf');
            $mpdf->Output('Log Book.pdf','I');
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
        
    }

    public function print_logbook_pdf_admin($id_kelompok)
    {
        // Inisialisasi Helper
        $TglIndo = new ConvertTglIndo();
        // variabel waktu sekarang
        $myTime = new Time('now');
        // membuat variabel dari session
		$roles = session('roles');
        if($roles == "admin"){
            // menampilkan nama kelomppk
            $proposal   = $this->db->query("SELECT * FROM proposal WHERE status_proposal='1' AND id_kelompok='$id_kelompok' ")->getRowArray();
            // tampilkan data absen sesuai parameter
            $logbook   = $this->db->query("SELECT a.*, b.nama FROM logbook AS a INNER JOIN users AS b ON a.id_users=b.id_users AND a.id_kelompok=b.id_kelompok WHERE a.id_kelompok='$id_kelompok' ")->getResultArray();
            $d_logbook   = $this->db->query("SELECT a.* FROM d_logbook AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid WHERE (a.files NOT LIKE '%.mp4%' AND a.files NOT LIKE '%.mpeg%' AND a.files NOT LIKE '%webm%') AND b.id_kelompok='$id_kelompok' ")->getResultArray();
            // tampilkan data yang diquery
            $dataArray = [
            'TglIndo'           => $TglIndo,
            'logbook'    	    => $logbook,
            'd_logbook'    	    => $d_logbook,
            'proposal'          => $proposal,
            ];

            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
            $html = view('admin/logbook/lap_logbook_pdf', $dataArray);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle("Log Book");
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            $mpdf->showImageErrors = true;
            //    $mpdf->WriteHTML('<h1>Hello world!</h1>');
            $this->response->setContentType('application/pdf');
            $mpdf->Output('Log Book.pdf','I');
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

    public function print_logbook_pdf_kelompok()
    {
        // Inisialisasi Helper
        $TglIndo = new ConvertTglIndo();
        // variabel waktu sekarang
        $myTime = new Time('now');
        // membuat variabel dari session
		$roles = session('roles');
		$id_kelompok = session('id_kelompok');
        if($roles == "peserta"){
            // menampilkan nama kelomppk
            $proposal   = $this->db->query("SELECT * FROM proposal WHERE status_proposal='1' AND id_kelompok='$id_kelompok' ")->getRowArray();
            // tampilkan data absen sesuai parameter
            $logbook   = $this->db->query("SELECT a.*, b.nama FROM logbook AS a INNER JOIN users AS b ON a.id_users=b.id_users AND a.id_kelompok=b.id_kelompok WHERE a.id_kelompok='$id_kelompok' ")->getResultArray();
            $d_logbook   = $this->db->query("SELECT * FROM d_logbook AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid WHERE (a.files NOT LIKE '%.mp4%' AND a.files NOT LIKE '%.mpeg%' AND a.files NOT LIKE '%webm%') AND b.id_kelompok='$id_kelompok' ")->getResultArray();
            // tampilkan data yang diquery
            $dataArray = [
            'TglIndo'           => $TglIndo,
            'logbook'    	    => $logbook,
            'd_logbook'    	    => $d_logbook,
            'proposal'          => $proposal,
            ];

            $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
            $html = view('users/logbook/lap_logbook_pdf_kelompok', $dataArray);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle("Log Book");
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            $mpdf->showImageErrors = true;
            //    $mpdf->WriteHTML('<h1>Hello world!</h1>');
            $this->response->setContentType('application/pdf');
            $mpdf->Output('Log Book.pdf','I');
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

}
