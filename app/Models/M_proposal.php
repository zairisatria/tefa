<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_proposal extends Model
{
    protected $table = "proposal";

    public function tampil_data_admin_baru()
    {
        $roles = session('roles');
        $id_prodi = session('id_prodi');
        if($roles == "pembimbing"){
            $where_prodi = "and users.id_prodi='$id_prodi' ";
        }else{
            $where_prodi = "";
        }

        $builder = $this->table('proposal');
        $builder->select('proposal.*');
        $builder->join('users', 'users.id_kelompok = proposal.id_kelompok', 'inner');
        $builder->where(" proposal.status_proposal='0' $where_prodi ");
        $builder->groupBy('users.id_kelompok');
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

    public function tampil_data_admin_diterima()
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

    public function tampil_data_admin_ditolak()
    {
        $roles = session('roles');
        $id_prodi = session('id_prodi');
        if($roles == "pembimbing"){
            $where_prodi = "and users.id_prodi='$id_prodi' ";
        }else{
            $where_prodi = "";
        }

        $builder = $this->table('proposal');
        $builder->select('proposal.*');
        $builder->join('users', 'users.id_kelompok = proposal.id_kelompok', 'inner');
        $builder->where(" proposal.status_proposal='2' $where_prodi ");
        $builder->groupBy('users.id_kelompok');
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

    public function pencarian_admin_baru($keyword_baru)
    {
        $roles = session('roles');
        $id_prodi = session('id_prodi');
        if($roles == "pembimbing"){
            $where_prodi = "and users.id_prodi='$id_prodi' ";
        }else{
            $where_prodi = "";
        }

        $builder = $this->table('proposal');
        $builder->select('proposal.*');
        $builder->join('users', 'users.id_kelompok = proposal.id_kelompok', 'inner');
        $builder->where(" proposal.status_proposal='0' $where_prodi ");
        $builder->where(" proposal.judul like '%$keyword_baru%' ");
        $builder->groupBy('users.id_kelompok');
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

    public function pencarian_admin_diterima($keyword)
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

    public function pencarian_admin_ditolak($keyword_ditolak)
    {
        $roles = session('roles');
        $id_prodi = session('id_prodi');
        if($roles == "pembimbing"){
            $where_prodi = "and users.id_prodi='$id_prodi' ";
        }else{
            $where_prodi = "";
        }

        $builder = $this->table('proposal');
        $builder->select('proposal.*');
        $builder->where(" proposal.status_proposal='2' $where_prodi ");
        $builder->where(" proposal.judul like '%$keyword_ditolak%' ");
        $builder->groupBy('users.id_kelompok');
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

}