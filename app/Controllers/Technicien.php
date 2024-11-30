<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DemandeModel;

class Technicien extends BaseController
{
    public function index()
    {
        // Vérification de l'authentification et du rôle
        if (!session()->get("is_logged_in")) {
            return redirect()->to("/login");
        } elseif (session()->get("role") !== "technicien") {
            return redirect()->to("/login");
        }


        $demandeModel = new DemandeModel();

        $technicienId = session()->get("user_id");

        $userModel = new UserModel();
        $technicien = $userModel->find($technicienId);
        $disponibilite = $technicien['disponibilite'];

        $nombreTaches = $demandeModel
            ->where('id_technicien', $technicienId)
            ->countAllResults();

        $data = [
            'nombreTaches' => $nombreTaches,
            'id_user' => $technicienId,
            'dispo' => $disponibilite,
            'user' => $technicien,
        ];

        return view('technicien/dashboard', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nom' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Le champ Nom est obligatoire.',
                    'min_length' => 'Le Nom doit contenir au moins 3 caractères.',
                    'max_length' => 'Le Nom ne peut pas dépasser 50 caractères.'
                ]
            ],
            'prenom' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Le champ Prénom est obligatoire.',
                    'min_length' => 'Le Prénom doit contenir au moins 3 caractères.',
                    'max_length' => 'Le Prénom ne peut pas dépasser 50 caractères.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Le champ Email est obligatoire.',
                    'valid_email' => 'L\'email doit être valide.'
                ]
            ],
            'phone' => [
                'rules' => 'required|regex_match[/^[0-9]{10}$/]',
                'errors' => [
                    'required' => 'Le champ Téléphone est obligatoire.',
                    'regex_match' => 'Le numéro de téléphone doit contenir exactement 10 chiffres.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $userModel = new UserModel();
            $technicien = $userModel->find($id);

            return view('technicien/edit', [
                'validation' => $this->validator,
                'technicien' => $technicien
            ]);
        }

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');

        $userModel = new UserModel();

        $existingUser = $userModel->where('email', $email)->where('id !=', $id)->first();
        if ($existingUser) {
            return redirect()->back()->withInput()->with('error', 'Cet email est déjà utilisé par un autre utilisateur');
        }

        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'phone' => $phone,
            'disponibilite' => 'disponibilite',
        ];

        $userModel->update($id, $data);

        return redirect()->to('/admin/gestion_technicien')->with('success', 'Technicien mis à jour avec succès');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        if ($userModel->delete($id)) {
            return redirect()->to('/admin/gestion_technicien')->with('success', 'Technicien supprimé avec succès');
        } else {
            return redirect()->to('/admin/gestion_technicien')->with('error', 'Une erreur s\'est produite lors de la suppression');
        }
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $technicien = $userModel->find($id);

        if (!$technicien) {
            return redirect()->to('/admin/gestion_technicien')->with('error', 'Technicien non trouvé');
        }

        return view('admin/edit_technicien', ['technicien' => $technicien]);
    }




    //--------mesTaches---------

    public function mes_taches()
    {
        $demandeModel = new DemandeModel();
    
        $technicienId = session()->get("user_id");
    
        $taches = $demandeModel
            ->where('id_technicien', $technicienId)  
            ->where('statut', 'en cours')             
            ->findAll();                             
    
        $data = [
            'taches' => $taches,
        ];
    
        return view('technicien/mes_taches', $data);
    }
    

    public function modifierDisponibilite()
    {
        $userModel = new UserModel();

        $id_user = $this->request->getPost('id_user');
        $nouvelleDispo = $this->request->getPost('dispo');

        // Vérifier si les données nécessaires sont présentes
        if (empty($id_user) || $nouvelleDispo === null) {
            return redirect()->back()->with('error', 'Données invalides ou manquantes.');
        }

        // Mettre à jour la disponibilité dans la base de données
        try {
            $updateSuccess = $userModel->update($id_user, ['disponibilite' => $nouvelleDispo]);

            if ($updateSuccess) {
                // Si la mise à jour réussit
                return redirect()->back()->with('message', 'Disponibilité mise à jour avec succès.');
            } else {
                // Si la mise à jour échoue
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la disponibilité.');
            }
        } catch (\Exception $e) {
            // Gestion des exceptions
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function terminer_tache($id)
    {
        $demandeModel = new DemandeModel();
    
        $demande = $demandeModel->find($id);
    
        if (!$demande) {
            return redirect()->back()->with('error', 'Impossible de terminer la demande.');
        }
    
        $demandeModel->update($id, ['statut' => 'Terminée']);
    
        return redirect()->to('/technicien/mes_taches')->with('success', 'Demande terminée avec succès.');
    }
    public function mes_taches_terminées()
{
    $demandeModel = new DemandeModel();

    $technicienId = session()->get("user_id");

    $tachesTerminees = $demandeModel
        ->where('id_technicien', $technicienId)
        ->where('statut', 'terminée')  
        ->findAll();

    $data = [
        'taches' => $tachesTerminees,
    ];

    return view('technicien/taches_terminer', $data);
}

    
}
