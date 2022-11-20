<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Helpers\ConvertTglIndo;

class Evaluasi extends BaseController
{
    public function index()
    {
        // membuat variabel session user
		$roles = session('roles');
		$id_prodi = session('id_prodi');
        if ($roles=="pembimbing"){
            // Tampilkan pilihan hanya prodi yang dibimbing
            $prodi   = $this->db->query("SELECT * FROM prodi WHERE id='$id_prodi' ")->getResultArray();
        }else{
            // Tampilkan pilihan semua prodi
            $prodi   = $this->db->query("SELECT * FROM prodi")->getResultArray();
        }
            $data = [
                'prodi'        => $prodi,
            ];
        return view('admin/evaluasi/evaluasi', $data);
    }
    public function laporan_evaluasi_pdf()
    {
        // validasi
        if (!$this->validate([
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program studi harus dipilih'
                ]
            ],
        ])){
            // jika tidak tervalidasi semua tampilan pesan error validasi
            session()->setFlashdata('invalidation', $this->validator->listErrors());
            // jika tidak tervalidasi kembali ke form input dan kembalikan nilai inputan sebelumnya
            return redirect()->back()->withInput();
        }

        // Inisialisasi Helper
        $TglIndo = new ConvertTglIndo();
        // variabel waktu sekarang
        $myTime = new Time('now');

        $prodi = $this->request->getVar('prodi');

        // membuat variabel dari session
		$roles = session('roles');
        if($roles != "peserta"){
            // cek apakah data untuk laporan sudah ada
            $cek_alat   = $this->db->query(" SELECT a.* FROM alat AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY a.id_kelompok, a.alat, b.id_prodi ")->getRowArray();
            $cek_bahan   = $this->db->query(" SELECT a.* FROM bahan AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY a.id_kelompok, a.bahan, b.id_prodi ")->getRowArray();
            $cek_langkah   = $this->db->query(" SELECT a.* FROM langkah AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY a.id_kelompok, a.langkah, b.id_prodi ")->getRowArray();
            
            if($cek_alat && $cek_bahan && $cek_langkah){
                // menampilkan nama kelomppk
                $proposal   = $this->db->query(" SELECT a.* FROM proposal AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE a.status_proposal='1' AND b.id_prodi='$prodi' GROUP BY a.id ")->getResultArray();
                $anggota_kelompok   = $this->db->query(" SELECT a.id_kelompok, a.judul, CASE WHEN b.status_kelompok='1' THEN CONCAT(b.nama,' (Ketua)') ELSE b.nama END AS nama FROM proposal AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE a.status_proposal='1' AND b.id_prodi='$prodi' ORDER BY a.id_kelompok, b.status_kelompok ")->getResultArray();
                $alat   = $this->db->query(" SELECT a.id_kelompok, a.judul, b.alat FROM proposal AS a INNER JOIN alat AS b ON a.id_kelompok=b.id_kelompok INNER JOIN users AS c ON a.id_kelompok=c.id_kelompok WHERE a.status_proposal='1' AND c.id_prodi='$prodi' GROUP BY b.id ORDER BY a.id_kelompok  ")->getResultArray();
                $bahan   = $this->db->query(" SELECT a.*, b.judul, c.satuan, c.konversi_satuan, c.nilai_konversi FROM bahan AS a INNER JOIN proposal b ON a.id_kelompok=b.id_kelompok INNER JOIN m_satuan AS c ON a.satuan=c.id INNER JOIN users AS d ON b.id_kelompok=d.id_kelompok WHERE b.status_proposal='1' AND d.id_prodi='$prodi' GROUP BY a.id ORDER BY a.id DESC ")->getResultArray();
                $biaya   = $this->db->query(" SELECT a.* FROM ( SELECT a.id_kelompok, a.judul, SUM(b.harga*b.jumlah) AS jumlah FROM proposal AS a INNER JOIN bahan AS b ON a.id_kelompok=b.id_kelompok WHERE a.status_proposal='1' GROUP BY a.id_kelompok ORDER BY a.id_kelompok ) AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY a.id_kelompok ")->getResultArray();
                $total   = $this->db->query(" SELECT a.jumlah AS total FROM ( SELECT a.id_kelompok, a.judul, SUM(b.harga*b.jumlah) AS jumlah FROM proposal AS a INNER JOIN bahan AS b ON a.id_kelompok=b.id_kelompok WHERE a.status_proposal='1' ) AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY b.id_prodi ")->getRowArray();
                $total_produksi   = $this->db->query(" SELECT a.* FROM ( SELECT a.id_kelompok, SUM(b.harga*b.jumlah) AS total FROM proposal AS a INNER JOIN bahan AS b ON a.id_kelompok=b.id_kelompok WHERE a.status_proposal='1' GROUP BY a.id_kelompok ORDER BY a.id_kelompok ) AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY a.id_kelompok ")->getResultArray();
                $jumlah_produksi   = $this->db->query(" SELECT a.* FROM ( SELECT id_kelompok, COUNT(id) AS jumlah_produksi FROM logbook WHERE jenis_aktifitas='produksi' GROUP BY id_kelompok ) AS a INNER JOIN users AS b ON a.id_kelompok=b.id_kelompok WHERE b.id_prodi='$prodi' GROUP BY a.id_kelompok ")->getResultArray();
                $logbook   = $this->db->query(" SELECT a.*, b.judul FROM logbook AS a INNER JOIN proposal AS b ON a.id_kelompok=b.id_kelompok INNER JOIN users AS c ON a.id_kelompok=b.id_kelompok WHERE b.status_proposal='1' AND c.id_prodi='$prodi' GROUP BY a.id_kelompok ")->getResultArray();
                $d_logbook   = $this->db->query(" SELECT a.* FROM d_logbook AS a INNER JOIN logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid INNER JOIN users AS c ON a.id_kelompok=b.id_kelompok WHERE (a.files NOT LIKE '%.mp4%' AND a.files NOT LIKE '%.mpeg%' AND a.files NOT LIKE '%webm%') AND c.id_prodi='$prodi' GROUP BY a.id_kelompok, a.id ")->getResultArray();
                // tampilkan data yang diquery
                $dataArray = [
                'TglIndo'               => $TglIndo,
                'proposal'              => $proposal,
                'anggota_kelompok'      => $anggota_kelompok,
                'alat'                  => $alat,
                'bahan'                 => $bahan,
                'biaya'                 => $biaya,
                'total'                 => $total,
                'total_produksi'        => $total_produksi,
                'jumlah_produksi'       => $jumlah_produksi,
                'logbook'               => $logbook,
                'd_logbook'             => $d_logbook,
                ];

                $mpdf = new \Mpdf\Mpdf([
                    'default_font_size' => 12,
                    'default_font' => 'Times New Roman'
                ]);

                $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
                $html = view('admin/evaluasi/evaluasi_pdf', $dataArray);
                $mpdf->SetProtection(array('print'));
                $mpdf->SetTitle("Evaluasi");
                $mpdf->SetDisplayMode('fullpage');
                // $mpdf->setFooter('<div class="box-footer text-center text-white">{PAGENO}</div>');
                // $mpdf->setFooter('<div style="text-align: center;">{PAGENO}</div>');
                $mpdf->WriteHTML($html);
                $mpdf->showImageErrors = true;
                //    $mpdf->WriteHTML('<h1>Hello world!</h1>');
                $this->response->setContentType('application/pdf');
                $mpdf->Output('Evaluasi.pdf','I');
            }else{
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Belum ada data jobsheet');
                return redirect()->back()->withInput();
            }
        }else{
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Anda tidak memiliki akses pada halaman ini');
            return redirect()->back();
        }
    }

}
