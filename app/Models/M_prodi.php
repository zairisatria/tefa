<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_prodi extends Model
{
    protected $table = "prodi";

    public function tampil_data()
    {        
        $builder = $this->table('prodi');
        $builder->select('*');
        $builder->orderBy('prodi.id', 'DESC');
        return $builder;
    }

    public function pencarian($keyword)
    {
        $builder = $this->table('prodi');
        $builder->select('*');
        $builder->where(" prodi.prodi like '%$keyword%' ");
        $builder->orderBy('prodi.id', 'DESC');
        return $builder;
    }


}