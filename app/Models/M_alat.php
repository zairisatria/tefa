<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_alat extends Model
{
    protected $table = "alat";

    public function tampil_data_user()
    {
        // ambil id Users tampung kedalam variabel
        $id_kelompok = session('id_kelompok');

        $builder = $this->table('alat');
        $builder->select('*');
        $where = " alat.id_kelompok='$id_kelompok' ";
        $builder->where($where);
        $builder->orderBy('alat.id', 'DESC');
        return $builder;
    }

}