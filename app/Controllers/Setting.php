<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Setting extends BaseController
{
    public function index()
	{
		// membuat variabel session user
		$roles = session('roles');
		$myTime = new Time('now');

		// membuat tampilan home yang berbeda antara superadmin,admin, dan users
		if ($roles=="admin"){
            // query tampilkan data setting
			$setting   = $this->db->query("SELECT * FROM setting ")->getRowArray();
			// menampung data yang diquery didalam satu variabel data
			$data = [
				'setting' 	=> $setting,
			];
			return view('admin/setting/setting', $data);
		}else{
			return redirect()->back();
		}
	}

	public function update()
    {
        // validasi
        if (!$this->validate([
            'batas_proposal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Batas perbaikan proposal harus diisi',
                    'numeric' => 'Harus berisi angka'
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
        $batas_proposal = $this->request->getVar('batas_proposal');
        // jalankan query update
        $update = $this->db->query("UPDATE setting SET batas_proposal='" .$this->db->escapeString($batas_proposal). "', updated_at='$myTime' ");
        // jika query dijalankan
        if($update && $this->db->affectedRows() > 0) {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'success');
            session()->setFlashdata('message', 'Update data berhasil...');
            return redirect()->to(site_url('/setting'));
        } else {
            // membuat session ubah dikirim di view untuk menampilkan SweetAlert
            session()->setFlashdata('flashdata', 'error');
            session()->setFlashdata('message', 'Update data gagal...!');
            return redirect()->back()->withInput();
        }
    }

}
