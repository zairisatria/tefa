<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_Jobsheet extends Model
{
    protected $table = "proposal";


    public function tampil_data_admin()
    {
        $roles = session('roles');
        $id_prodi = session('id_prodi');
        if($roles == "pembimbing"){
            $where_prodi = "and users.id_prodi='$id_prodi' ";
        }else{
            $where_prodi = "";
        }

        $builder = $this->table('proposal');
        $builder->select('proposal.*, users.nama');
        $builder->join('map_pembimbing', 'map_pembimbing.id_proposal = proposal.id', 'inner');
        $builder->join('users', 'users.id_users = map_pembimbing.id_pembimbing', 'inner');
        $builder->where(" proposal.status_proposal='1' $where_prodi ");
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

    public function pencarian_admin($keyword)
    {
        $roles = session('roles');
        $id_prodi = session('id_prodi');
        if($roles == "pembimbing"){
            $where_prodi = "and users.id_prodi='$id_prodi' ";
        }else{
            $where_prodi = "";
        }

        $builder = $this->table('proposal');
        $builder->select('proposal.*, users.nama');
        $builder->join('map_pembimbing', 'map_pembimbing.id_proposal = proposal.id', 'inner');
        $builder->join('users', 'users.id_users = map_pembimbing.id_pembimbing', 'inner');
        $builder->where(" proposal.status_proposal='1' $where_prodi ");
        $builder->where(" proposal.judul like '%$keyword%' ");
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

}