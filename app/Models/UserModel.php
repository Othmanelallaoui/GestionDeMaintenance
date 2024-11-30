<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; 
    
    protected $primaryKey = 'id'; 

    protected $allowedFields = ['CIN', 'nom', 'prenom', 'email', 'phone', 'password', 'role', 'disponibilite'];

    /**
     * Récupère tous les utilisateurs ayant le rôle de technicien.
     *
     * @return array Liste des techniciens.
     */
    public function getTechniciens() {
        return $this->where('role', 'technicien')->findAll();
    }

    /**
     * Récupère les techniciens en fonction de leur disponibilité.
     *
     * @param string $disponibilite (Optionnel) Statut de disponibilité (par défaut : 'disponible').
     * @return array Liste des techniciens filtrés par disponibilité.
     */
    public function getTechniciensDisponibilite($disponibilite = 'disponible') {
        return $this->where('role', 'technicien')
                    ->where('disponibilite', $disponibilite)
                    ->findAll();
    }
}
