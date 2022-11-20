<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_bahan extends Model
{
    protected $table = "bahan";

    public function tampil_data_user()
    {
        // ambil id Users tampung kedalam variabel
        $id_kelompok = session('id_kelompok');

        $builder = $this->table('bahan');
        $builder->select('*');
        $where = " bahan.id_kelompok='$id_kelompok' ";
        $builder->where($where);
        $builder->orderBy('bahan.id', 'DESC');
        return $builder;
    }

}