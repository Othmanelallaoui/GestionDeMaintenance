<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['CIN', 'nom', 'prenom', 'email', 'phone', 'password', 'role'];
    public function getTechniciens() {
        return $this->where('role', 'technicien')->findAll(); // Vérifie que la colonne "role" existe dans ta table
    }
}
