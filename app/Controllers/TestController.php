<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class TestController extends Controller
{
    public function testDbConnection()
    {
        // Tente de se connecter à la base de données
        $db = \Config\Database::connect();

        if ($db->connID) {
            echo 'Connexion réussie à la base de données !';
        } else {
            echo 'Échec de la connexion à la base de données.';
        }
    }
}
