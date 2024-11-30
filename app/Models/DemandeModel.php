<?php
namespace App\Models;

use CodeIgniter\Model;

class DemandeModel extends Model
{
    protected $table = 'demandes_clients'; // Nom de la table
    protected $primaryKey = 'id'; // Clé primaire

    // Champs autorisés pour les opérations d'insertion et de mise à jour
    protected $allowedFields = ['id_client', 'titre', 'descr', 'telephone_client', 'statut', 'id_technicien', 'date_creation'];

    /**
     * Récupérer toutes les demandes avec les détails des clients et techniciens,
     * en excluant les statuts spécifiques ('Annulée', 'Terminée', 'Refusée').
     */
    public function getDemandesWithDetails()
    {
        return $this->select('demandes_clients.*, 
                              technicien.nom AS nom_technicien, 
                              client.nom AS nom_client,
                              client.CIN AS CIN')
                    ->join('users AS technicien', 'technicien.id = demandes_clients.id_technicien', 'left')
                    ->join('users AS client', 'client.id = demandes_clients.id_client', 'left')
                    ->whereNotIn('demandes_clients.statut', ['Annulée', 'Terminée', 'Refusée']) // Exclure ces statuts
                    ->findAll();
    }

    /**
     * Récupérer uniquement les demandes ayant des statuts spécifiques ('Annulée', 'Terminée', 'Refusée'),
     * avec les détails des clients et techniciens.
     */
    public function getDemandesWithSpecificStatuses()
    {
        return $this->select('demandes_clients.*, 
                              technicien.nom AS nom_technicien, 
                              client.nom AS nom_client,
                              client.CIN AS CIN')
                    ->join('users AS technicien', 'technicien.id = demandes_clients.id_technicien', 'left')
                    ->join('users AS client', 'client.id = demandes_clients.id_client', 'left')
                    ->whereIn('demandes_clients.statut', ['Annulée', 'Terminée', 'Refusée']) 
                    ->findAll();
    }
}
