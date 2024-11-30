<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DemandeModel;

class Admin extends BaseController
{

    public function index()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }


        $userModel = new UserModel();
        $demandeModel = new DemandeModel();

        $nombreClients = $userModel->where('role', 'client')->countAllResults();
        $nombreTechniciens = $userModel->where('role', 'technicien')->countAllResults();
        $nombreAdmins = $userModel->where('role', 'administrateur')->countAllResults();
        $nombreTechniciensDispo = $userModel->where('role', 'technicien')->where('disponibilite', 'disponible')->countAllResults();
        $nombreTechniciensIndispo = $userModel->where('role', 'technicien')->where('disponibilite', 'indisponible')->countAllResults();

        $nombreDemandesEnAttente = $demandeModel->where('statut', 'en attente')->countAllResults();
        $nombreDemandesEnCours = $demandeModel->where('statut', 'en cours')->countAllResults();
        $nombreDemandesTerminees = $demandeModel->where('statut', 'terminée')->countAllResults();

        $data = [
            'nombreClients' => $nombreClients,
            'nombreTechniciens' => $nombreTechniciens,
            'nombreTechniciensDispo' => $nombreTechniciensDispo,
            'nombreTechniciensIndispo' => $nombreTechniciensIndispo,
            'nombreAdmins' => $nombreAdmins,
            'nombreDemandesEnAttente' => $nombreDemandesEnAttente,
            'nombreDemandesEnCours' => $nombreDemandesEnCours,
            'nombreDemandesTerminees' => $nombreDemandesTerminees,
        ];

        return view('admin/dashboard', $data);
    }

    public function profil()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        return view('admin/profilAdmin');
    }
    //----------------------Techniciens---------------------
    public function gestion_technicien()
    {

        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $techniciens = $userModel->where('role', 'technicien')->findAll();
        return view('admin/gestion_technicien', ['techniciens' => $techniciens]);
    }
    public function ajouter_technicien()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        return view('admin/ajouter_technicien');
    }

    public function store_technicien()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();

        $rules = [
            'CIN' => [
                'rules' => 'required|is_unique[users.CIN]',
                'errors' => [
                    'required' => 'Tu dois saisir un CIN',
                    'is_unique' => 'Cet CIN est déjà utilisé.'

                ]
            ],
            'prenom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tu dois saisir un prénom',
                ]
            ],
            'nom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tu dois saisir un nom'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Tu dois saisir un email',
                    'valid_email' => 'Tu dois saisir un email valide',
                    'is_unique' => 'Cet email est déjà utilisé. Choisis un autre email.'
                ]
            ],
            'phone' => [
                'rules' => 'required|numeric|exact_length[10]',
                'errors' => [
                    'required' => 'Tu dois saisir un numéro de téléphone',
                    'numeric' => 'Le numéro de téléphone doit être composé uniquement de chiffres',
                    'exact_length' => 'Le numéro de téléphone doit comporter exactement 10 chiffres'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            return view('admin/ajouter_technicien', [
                'validation' => $this->validator,
            ]);
        } else {

            $CIN = $this->request->getPost('CIN');
            $nom = strtoupper($this->request->getPost('nom'));

            $defaultPassword = password_hash("{$nom}@{$CIN}", PASSWORD_BCRYPT);

            $data = [
                'CIN' => $CIN,
                'nom' => $this->request->getPost('nom'),
                'prenom' => $this->request->getPost('prenom'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'password' => $defaultPassword,
                'role' => 'technicien',
            ];

            $userModel->save($data);
            session()->setFlashdata('success', 'Technicien ajouté avec succès !');
            return redirect()->to('/admin/gestion_technicien');
        }
    }
    public function reset_password($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();

        $technicien = $userModel->find($id);
        if (!$technicien) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé');
        }

        $newPassword = bin2hex(random_bytes(4));
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $userModel->update($id, ['password' => $hashedPassword]);

        $emailService = \Config\Services::email();
        $emailService->setFrom('othmanelallaoui2022@gmail.com', 'Centre d\'excellence FSA');
        $emailService->setTo($technicien['email']);
        $emailService->setSubject('Réinitialisation de votre mot de passe');
        $message = "

        Bonjour Mr. <u>{$technicien['nom']}</u>,        
        Votre mot de passe a été réinitialisé avec succès. Votre nouveau mot de passe est :<b>  {$newPassword}</b>        
        <br/>Nous vous recommandons de le modifier dès votre première connexion.
        role:<u>{$technicien['role']}</u>
        <br/>Cordialement,
        <br/>Centre d'excelenace FSA ";


        $emailService->setMessage($message);

        if ($emailService->send()) {
            return redirect()->to('/admin/gestion_technicien')->with('success', 'Le mot de passe a été réinitialisé avec succès. Un email contenant le nouveau mot de passe a été envoyé.');
        } else {
            log_message('error', $emailService->printDebugger(['headers', 'subject', 'body']));
            return redirect()->to('/admin/gestion_technicien')->with('error', 'Le mot de passe a été réinitialisé, mais l\'email n\'a pas pu être envoyé.');
        }
    }


    //-----------------------gestion Clients-----------------------
    public function gestion_clients()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $clients = $userModel->where('role', 'client')->findAll();
        return view('admin/gestion_clients', ['clients' => $clients]);
    }

    //------------gestion demandes------------
    public function gestion_Demandes()
    {
        // Vérifie si l'utilisateur est connecté et s'il est un administrateur
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }

        $demandeModel = new DemandeModel();

        // Récupère toutes les demandes en excluant les statuts 'Annulée', 'Terminée', 'Refusée'
        $demandesFiltrees = $demandeModel->getDemandesWithDetails();

        // Retourne la vue avec les demandes filtrées
        return view('admin/gestion_demandes', ['Demandes' => $demandesFiltrees]);
    }

    public function archive_Demandes()
    {
        // Vérifie si l'utilisateur est connecté et s'il est un administrateur
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
    
        $demandeModel = new DemandeModel();
    
        // Récupérer uniquement les demandes avec les statuts 'Annulée', 'Terminée', 'Refusée'
        $demandesArchives = $demandeModel->getDemandesWithSpecificStatuses();
    
        // Retourner la vue avec les demandes archivées
        return view('admin/demandes_archives', ['Demandes' => $demandesArchives]);
    }
    


    public function assigner_taches()
    {
        $userModel = new UserModel();  // Assurez-vous que le modèle UserModel est importé
        $demandeModel = new DemandeModel();  // Assurez-vous que le modèle DemandeModel est importé

        // Récupérer les techniciens disponibles
        $techniciens = $userModel->getTechniciensDisponibilite('disponible');

        // Récupérer les demandes en attente
        $demandes = $demandeModel->where('statut', 'en attente')->findAll();

        return view('admin/assigner_taches', [
            'techniciens' => $techniciens,
            'demandes' => $demandes
        ]);
    }

    public function assigner_tache()
    {
        $userModel = new UserModel();
        $demandeModel = new DemandeModel();

        $technicien_id = $this->request->getPost('technicien_id');
        $demande_id = $this->request->getPost('demande_id');

        $userModel->update($technicien_id, ['disponibilite' => 'INDISPONIBLE']);

        // Mettre à jour le statut de la demande et associer le technicien
        $demandeModel->update($demande_id, [
            'statut' => 'en cours',
            'id_technicien' => $technicien_id
        ]);

        return redirect()->to('/admin/assigner_taches_technicien')->with('success', 'Tâche assignée avec succès !');
    }
}
