<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_langkah extends Model
{
    protected $table = "langkah";

    public function tampil_data_user()
    {
        // ambil id Users tampung kedalam variabel
        $id_kelompok = session('id_kelompok');

        $builder = $this->table('langkah');
        $builder->select('*');
        $where = " langkah.id_kelompok='$id_kelompok' ";
        $builder->where($where);
        $builder->orderBy('langkah.id', 'ASC');
        return $builder;
    }

}