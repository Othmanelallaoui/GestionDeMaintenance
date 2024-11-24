<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }

        // Charger le modèle UserModel
        $userModel = new UserModel();

        // Compter les utilisateurs par rôle
        $nombreClients = $userModel->where('role', 'client')->countAllResults();
        $nombreTechniciens = $userModel->where('role', 'technicien')->countAllResults();
        $nombreAdmins = $userModel->where('role', 'administrateur')->countAllResults();

        // Passer les données à la vue
        $data = [
            'nombreClients' => $nombreClients,
            'nombreTechniciens' => $nombreTechniciens,
            'nombreAdmins' => $nombreAdmins
        ];

        return view('admin/dashboard', $data);
    }

    public function profil()
    {
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
    public function gestion_client()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $clients = $userModel->where('role', 'client')->findAll();
        return view('admin/gestion_clients', ['clients' => $clients]);
    }
}
