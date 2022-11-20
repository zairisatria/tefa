<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_logbook extends Model
{
    protected $table = "logbook";

    public function tampil_data()
    {
        // ambil id Users tampung kedalam variabel
        $id_users = session('id_users');
        $id_kelompok = session('id_kelompok');
        
        $builder = $this->table('logbook');
        $builder->select('logbook.*');
        $builder->where(" id_users='$id_users' ");
        $builder->orderBy('logbook.id', 'DESC');
        return $builder;
    }

    public function pencarian($from, $to)
    {
        // ambil id Users tampung kedalam variabel
        $id_users = session('id_users');
        $id_kelompok = session('id_kelompok');
    
        $builder = $this->table('logbook');
        $builder->select('logbook.*');
        $builder->where(" id_users='$id_users' AND (date(logbook.date) BETWEEN '$from' AND '$to') ");
        $builder->orderBy('logbook.id', 'DESC');
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
        $builder = $this->table('logbook');
        $builder->select('proposal.*, users.nama');
        $builder->join('proposal', 'proposal.id_kelompok = logbook.id_kelompok', 'inner');
        $builder->join('map_pembimbing', 'map_pembimbing.id_proposal = proposal.id', 'inner');
        $builder->join('users', 'users.id_users = map_pembimbing.id_pembimbing', 'inner');
        $builder->where(" proposal.status_proposal='1' $where_prodi ");
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

        $builder = $this->table('logbook');
        $builder->select('proposal.*, users.nama');
        $builder->join('proposal', 'proposal.id_kelompok = logbook.id_kelompok', 'inner');
        $builder->join('map_pembimbing', 'map_pembimbing.id_proposal = proposal.id', 'inner');
        $builder->join('users', 'users.id_users = map_pembimbing.id_pembimbing', 'inner');
        $builder->where(" proposal.status_proposal='1' $where_prodi ");
        $builder->where(" proposal.judul like '%$keyword%' ");
        $builder->groupBy('users.id_kelompok');
        $builder->orderBy('proposal.id', 'DESC');
        return $builder;
    }

}