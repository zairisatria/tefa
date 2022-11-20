<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_distribusi extends Model
{
    protected $table = "distribusi";

    public function tampil_data()
    {        
        $builder = $this->table('distribusi');
        $builder->join('toko', 'distribusi.id_toko = toko.id', 'inner');
        $builder->join('proposal', 'distribusi.id_proposal = proposal.id', 'inner');
        $builder->select('distribusi.*, toko.nama, proposal.judul');
        $builder->orderBy('distribusi.id', 'DESC');
        return $builder;
    }

    public function pencarian($keyword)
    {

        $builder = $this->table('distribusi');
        $builder->join('toko', 'distribusi.id_toko = toko.id', 'inner');
        $builder->join('proposal', 'distribusi.id_proposal = proposal.id', 'inner');
        $builder->select('distribusi.*, toko.nama, proposal.judul');
        $builder->where(" proposal.judul like '%$keyword%' or toko.nama like '%$keyword%'");
        $builder->orderBy('distribusi.id', 'DESC');
        return $builder;
    }

}