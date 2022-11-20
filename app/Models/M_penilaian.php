<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_penilaian extends Model
{
    protected $table = "penilaian";

    public function tampil_data()
    {        
        $builder = $this->table('penilaian');
        $builder->join('proposal', 'penilaian.id_kelompok = proposal.id_kelompok', 'inner');
        $builder->select('penilaian.*, proposal.judul');
        $builder->where(" proposal.status_proposal='1' ");
        $builder->orderBy('penilaian.id', 'DESC');
        return $builder;
    }

    public function pencarian($keyword)
    {
        $builder = $this->table('penilaian');
        $builder->join('proposal', 'penilaian.id_kelompok = proposal.id_kelompok', 'inner');
        $builder->select('penilaian.*, proposal.judul');
        $builder->where(" proposal.status_proposal='1' ");
        $builder->where(" proposal.judul like '%$keyword%' ");
        $builder->orderBy('penilaian.id', 'DESC');
        return $builder;
    }

}