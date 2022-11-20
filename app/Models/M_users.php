<?php

namespace App\Models;
 
use CodeIgniter\Model;
 
class M_users extends Model
{
    protected $table = "users";
    protected $primaryKey = "id_users";
    protected $returnType = "array";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kelompok','id_prodi','nama','username','password','email','telepon','photo','roles','token_kelompok','status_kelompok'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function tampil_data()
    {        
        $builder = $this->table('users');
        $builder->select('*');
        $builder->where(" users.roles != 'admin' and users.roles != 'peserta' ");
        $builder->orderBy('users.id_users', 'DESC');
        return $builder;
    }

    public function pencarian($keyword)
    {
        $builder = $this->table('users');
        $builder->select('*');
        $builder->where(" users.roles != 'admin' and users.roles != 'peserta' ");
        $builder->where(" users.nama like '%$keyword%' or users.email like '%$keyword%' or users.username like '%$keyword%' or users.roles like '%$keyword%' ");
        $builder->orderBy('users.id_users', 'DESC');
        return $builder;
    }
}