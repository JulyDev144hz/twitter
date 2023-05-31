<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class RolSeeder extends Seeder{
    public function run(){
        $this->db->query("INSERT INTO t_roles (nombre_rol) VALUES('owner')");
        $this->db->query("INSERT INTO t_roles (nombre_rol) VALUES('admin')");
        $this->db->query("INSERT INTO t_roles (nombre_rol) VALUES('user')");
    }
}