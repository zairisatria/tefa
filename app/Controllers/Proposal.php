<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Proposal extends BaseController
{
    public function index()
    {
        // ambil session dan tampung kedalam variabel
        $id_users = session('id_users');
        $id_kelompok = session('id_kelompok');
        $roles = session('roles');
        $myTime = new Time('now');

        // cek roles akun
        if ($roles == "peserta") {
            // proses manampilkan data peserta
            // query tampilkan data proposal
            $proposal   = $this->db->query("SELECT a.*, b.nama, d.nama AS nama_pembimbing FROM proposal AS a LEFT JOIN users AS b ON a.id_users_verifikasi=b.id_users LEFT JOIN map_pembimbing AS c ON a.id=c.id_proposal LEFT JOIN users AS d ON c.id_pembimbing=d.id_users WHERE a.id_kelompok='$id_kelompok' ORDER BY a.id DESC ")->getResultArray();
            // menampung data yang diquery didalam satu variabel data
            $data = [
                'proposal'     => $proposal,
            ];
            return view('users/proposal/proposal', $data);
        } else {
            // proses menampilkan data selain peserta
            // inisialisasi model
            $model_baru = new \App\Models\M_proposal();
            $model_diterima = new \App\Models\M_proposal();
            $model_ditolak = new \App\Models\M_proposal();
            // membuat perulangan nomor no++ dengan mengambil nilai url pagination
            $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            // variabel jumlah data yang ditampilkan dalam pagination
            $jumlah_baris_data = 5;

            // menangkap data pencarian
            $keyword_baru = $this->request->getVar('keyword_baru');
            $keyword = $this->request->getVar('keyword');
            $keyword_ditolak = $this->request->getVar('keyword_ditolak');
            if ($keyword_baru) {
                $cari_data_baru = $model_baru->pencarian_admin_baru($keyword_baru);
            } else {
                $cari_data_baru = $model_baru->tampil_data_admin_baru();
            };

            if ($keyword) {
                $cari_data_diterima = $model_diterima->pencarian_admin_diterima($keyword);
            } else {
                $cari_data_diterima = $model_diterima->tampil_data_admin_diterima();
            };

            if ($keyword_ditolak) {
                $cari_data_ditolak = $model_ditolak->pencarian_admin_ditolak($keyword_ditolak);
            } else {
                $cari_data_ditolak = $model_ditolak->tampil_data_admin_ditolak();
            };
            // tampilkan data pembimbing
            $pembimbing   = $this->db->query("SELECT * FROM users WHERE roles='pembimbing' ")->getResultArray();
            // menampung data kedalam variabel array untuk ditampilan ke view
            $data = [
                'data_pagination_baru'      => $cari_data_baru->paginate($jumlah_baris_data, 'default'),
                'data_pagination_diterima'  => $cari_data_diterima->paginate($jumlah_baris_data, 'default'),
                'data_pagination_ditolak'   => $cari_data_ditolak->paginate($jumlah_baris_data, 'default'),
                'pager_baru'                => $cari_data_baru->tampil_data_admin_baru()->pager,
                'pager_diterima'            => $cari_data_diterima->tampil_data_admin_diterima()->pager,
                'pager_ditolak'             => $cari_data_ditolak->tampil_data_admin_ditolak()->pager,
                'currentPage'               => $currentPage,
                'jumlah_baris_data'         => $jumlah_baris_data,
                'keyword_baru'              => $keyword_baru,
                'keyword'                   => $keyword,
                'keyword_ditolak'           => $keyword_ditolak,
                'pembimbing'                => $pembimbing,
            ];
            return view('admin/proposal/proposal', $data);
        }
    }

    public function tambah()
    {
        // ambil session dan tampung kedalam variabel
        $roles = session('roles');
        $id_kelompok = session('id_kelompok');
        $status_kelompok = session('status_kelompok');
        // cek roles akun
        if ($roles == "peserta") {
            if ($status_kelompok == '1') {
                // cek apakah masih ada proposal yang masih dalam pengajuan
                $cek_proposal   = $this->db->query("SELECT * FROM proposal WHERE id_kelompok='$id_kelompok' AND status_proposal !='2' ")->getRow();
                if ($cek_proposal) {
                    // cek proposal yang belum diproses
                    $status_baru   = $this->db->query("SELECT * FROM proposal WHERE id_kelompok='$id_kelompok' AND status_proposal ='0' ")->getRow();
                    if ($status_baru) {
                        // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                        session()->setFlashdata('flashdata', 'error');
                        session()->setFlashdata('message', 'Pengajuan tidak diizinkan, proposal yang baru diajukan belum diverifikasi');
                        return redirect()->back();
                    } else {
                        // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                        session()->setFlashdata('flashdata', 'error');
                        session()->setFlashdata('message', 'Pengajuan tidak diizinkan, anda sudah memiliki proposal yang disetujui');
                        return redirect()->back();
                    }
                } else {
                    // cek tanggal batas maksimal pengajuan perbaikan jika ditolak
                    $cek_batas_waktu   = $this->db->query("SELECT * FROM proposal WHERE id_kelompok='$id_kelompok' AND status_proposal ='2' ORDER BY id DESC LIMIT 1 ");
                    $batas_waktu =  $cek_batas_waktu->getRow();
                    $dibatasi =  $cek_batas_waktu->getRowArray();
                    if ($dibatasi) {
                        $waktu_proposal = $dibatasi['created_at'];
                    } else {
                        $waktu_proposal = "";
                    }
                    // ambil data setting
                    $setting   = $this->db->query("SELECT * FROM setting ")->getRowArray();
                    $setting_batas_waktu = $setting['batas_proposal'];
                    // cek selisih waktu apakah melebihi batas maksimal
                    $cek_selisih_waktu   = $this->db->query("SELECT LEFT(TIMEDIFF(NOW(), '$waktu_proposal')+0,2) AS selisih_waktu")->getRowArray();
                    if ($batas_waktu) {
                        if ($cek_selisih_waktu['selisih_waktu'] > $setting['batas_proposal']) {
                            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                            $alert_error = "Pengajuan melewati batas waktu, maksimal $setting_batas_waktu menit setelah dikoreksi";
                            session()->setFlashdata('flashdata', 'error');
                            session()->setFlashdata('message', $alert_error);
                            return redirect()->back();
                        } else {
                            return view('users/proposal/tambah');
                        }
                    } else {
                        return view('users/proposal/tambah');
                    }
                }
            } else {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Anda anggota kelompok, yang bisa mengajukan proposal hanya ketua kelompok');
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function simpan()
    {
        // validasi
        if (!$this->validate([
            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul proposal harus diisi'
                ]
            ],
            'files' => [
                'rules' => 'max_size[files,200000]|ext_in[files,pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file maksimal 200 MB',
                    'ext_in' => 'Jenis file yang dizinkan hanya (.pdf)',
                ]
            ],
        ])) {
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
        $judul = $this->request->getVar('judul');
        $file =  $this->request->getFile('files');
        // ambil nama file baru
        $namafile = $file->getRandomName();
        // pindahkan ke folder
        $file->move('files/proposal', $namafile);
        // cek apakah perbaikan atau pengajuan baru
        $cek_proposal   = $this->db->query("SELECT * FROM proposal WHERE id_kelompok='$id_kelompok' AND status_proposal ='2' ")->getRow();
        if ($cek_proposal) {
            $status_perbaikan = "1";
        } else {
            $status_perbaikan = "0";
        }
        // insert data ke tabel
        $insert = $this->db->query("INSERT INTO proposal(id_users, id_kelompok, files, judul, status_proposal, status_perbaikan, catatan_perbaikan, id_users_verifikasi, created_at, updated_at) VALUES ('$id_users', '$id_kelompok', '" . $this->db->escapeString($namafile) . "', '" . $this->db->escapeString($judul) . "', '0', '$status_perbaikan', '', '0', '$myTime', '$myTime')");
        // jika query dijalankan
        if ($insert && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Proposal berhasil diajukan');
            return redirect()->to(site_url('/proposal'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Pengajuan proposal gagal');
            return redirect()->back()->withInput();
        }
    }

    public function verifikasi()
    {
        // membuat variabel session
        $id_users = session('id_users');
        $roles = session('roles');
        // cek data kepemilikan
        if ($roles == "admin" || $roles == "kepala" || $roles == "kaprodi") {
            // menangkap post dari view kedalam variabel
            $id_proposal = $this->request->getVar('id_verifikasi_proposal');
            $id_kelompok = $this->request->getVar('id_kelompok');
            $status = $this->request->getVar('status_verifikasi');
            $id_pembimbing = $this->request->getVar('pembimbing');
            $status_perbaikan = '';
            $catatan = $this->request->getVar('catatan');
            $myTime = new Time('now');
            // update data
            $update = $this->db->query("UPDATE proposal SET status_proposal='$status', catatan_perbaikan='" . $this->db->escapeString($catatan) . "', id_users_verifikasi='$id_users', updated_at='$myTime' WHERE id='$id_proposal' ");
            if ($status == "1") {
                $insert = $this->db->query("INSERT INTO map_pembimbing (id_pembimbing, id_kelompok, id_proposal, created_at, updated_at) VALUES ('$id_pembimbing', '$id_kelompok', '$id_proposal', '$myTime', '$myTime') ");
            }
            // jika query dijalankan
            if ($update && $this->db->affectedRows() > 0) {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'success');
                session()->setFlashdata('message', 'Proposal berhasil diverifikasi');
                return redirect()->to(site_url('/proposal'));
            } else {
                // membuat session ubah dikirim di view untuk menampilkan SweetAlert
                session()->setFlashdata('flashdata', 'error');
                session()->setFlashdata('message', 'Pengajuan proposal gagal diverifikasi');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back();
        }
    }
}
