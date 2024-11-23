<?php

namespace App\Controllers;

use App\Models\UserModel;

class Technicien extends BaseController
{
    public function index()
    {
        if (!session()->get("is_logged_in")) {
            return redirect()->to("/login");
        } elseif (session()->get("role") !== "technicien") {
            return redirect()->to("/login");
        } else {
            return view('technicien/dashboard');
        }
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
}
