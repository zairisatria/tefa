<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_satuan extends Model
{
    protected $table = "m_satuan";

    public function tampil_data()
    {        
        $builder = $this->table('m_satuan');
        $builder->select('*');
        $builder->orderBy('m_satuan.id', 'DESC');
        return $builder;
    }

    public function pencarian($keyword)
    {
        $builder = $this->table('m_satuan');
        $builder->select('*');
        $builder->where(" m_satuan.satuan like '%$keyword%' ");
        $builder->orderBy('m_satuan.id', 'DESC');
        return $builder;
    }


}