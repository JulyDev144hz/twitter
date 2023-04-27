<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    public function getUsers(){
        $table = $this->db->table('t_usuarios');
        return $table->get()->getResultArray();
    }
    public function getUser($data){
        $table = $this->db->table('t_usuarios');
        $table->where($data);
        return $table->get()->getResultArray();
    }
    public function createUser($data){
        $table = $this->db->table('t_usuarios');
        if (!isset($table->where('username',$data['username'])->get()->getResultArray()[0])){
            $table->insert($data);
            return $this->db->insertID();

        }else{
            return 0;
        }
    }
    public function updateUser($data){
        $table = $this->db->table('t_usuarios');
        $table->where('id_user',$data['id_user']);
        $table->set($data);
        return $table->update();
    }
}