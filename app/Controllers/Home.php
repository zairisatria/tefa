<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index()
	{
		// membuat variabel session user
		$roles = session('roles');
		$id_users = session('id_users');
		$myTime = new Time('now');

		// membuat tampilan home yang berbeda antara superadmin,admin, dan users
		if ($roles=="peserta"){
			// tampilkan foto logbook
			$d_logbook   = $this->db->query("SELECT b.* FROM logbook AS a INNER JOIN d_logbook AS b ON a.id_kelompok=b.id_kelompok AND a.uuid=b.uuid WHERE a.id_users='$id_users' AND (b.files NOT LIKE '%.mp4%' AND b.files NOT LIKE '%.mpeg%') ")->getResultArray();
			// query tampilkan data users
			$users   = $this->db->query("SELECT * FROM users WHERE id_users='$id_users' ")->getRowArray();
			// menampung data yang diquery didalam satu variabel data
			$data = [
				'users' 		=> $users,
				'd_logbook' 	=> $d_logbook,
			];
			return view('users/home/home', $data);
		}else{
			// Membuat data chart anggaran/biaya
			$biaya   = $this->db->query(" SELECT a.id_kelompok, a.judul, SUM(b.harga*b.jumlah) AS total FROM proposal AS a INNER JOIN bahan AS b ON a.id_kelompok=b.id_kelompok WHERE a.status_proposal='1' GROUP BY a.id_kelompok ")->getResultArray();
			// Membuat data chart proposal yang diproses
			$proposal   = $this->db->query(" SELECT 'baru' AS status_proposal, COUNT(id_kelompok) AS jumlah FROM proposal WHERE status_proposal='0'
			UNION ALL
			SELECT 'diterima' AS status_proposal, COUNT(id_kelompok) AS jumlah FROM proposal WHERE status_proposal='1'
			UNION ALL
			SELECT 'ditolak' AS status_proposal, COUNT(id_kelompok) AS jumlah FROM proposal WHERE status_proposal='2' ")->getResultArray();
			// menampung data yang diquery didalam satu variabel data
			$data = [
				'biaya' 		=> $biaya,
				'proposal' 		=> $proposal,
			];
			return view('admin/home/home', $data);
		}
	}

}
