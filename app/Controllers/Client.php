<?php

namespace App\Controllers;

use App\Models\UserModel;

class Client extends BaseController
{
    public function index()
    {
        if (!session()->get("is_logged_in")) {
            return redirect()->to("/login");
        }
        if (session()->get("role") !== "client") {
            return redirect()->to("/login");
        }


        return view('client/dashboard');
    }
    public function create()
    {
        return view('client/inscriptionClient');
    }




    public function store()
    {
        $rules = [
            'cin' => [
                'rules' => 'required|min_length[6]|max_length[10]|is_unique[users.cin]',
                'errors' => [
                    'required' => 'Le CIN est obligatoire.',
                    'min_length' => 'Le CIN doit contenir au moins 6 caractères.',
                    'max_length' => 'Le CIN ne doit pas dépasser 10 caractères.',
                    'is_unique' => 'Le CIN existe déjà dans notre base de données.',
                ]
            ],
            'nom' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Le champ Nom est obligatoire.',
                    'min_length' => 'Le Nom doit contenir au moins 3 caractères.',
                ]
            ],
            'prenom' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Le champ Prénom est obligatoire.',
                    'min_length' => 'Le Prénom doit contenir au moins 3 caractères.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Le champ Email est obligatoire.',
                    'valid_email' => 'L\'adresse email fournie n\'est pas valide.',
                    'is_unique' => 'Cette adresse email est déjà utilisée.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Le champ Mot de passe est obligatoire.',
                    'min_length' => 'Le Mot de passe doit contenir au moins 6 caractères.',
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Le champ Confirmation du mot de passe est obligatoire.',
                    'matches' => 'Les mots de passe ne correspondent pas.',
                ]
            ],
            'phone' => [
                'rules' => 'required|numeric|exact_length[10]',
                'errors' => [
                    'required' => 'Le champ de téléphone est obligatoire.',
                    'exact_length' => 'Le numéro de téléphone doit contenir exactement 10 chiffres.',
                    'numeric' => 'Le numéro de téléphone doit contenir uniquement des chiffres.'
                ]
            ]
        ];
    
        if (!$this->validate($rules)) {
            return view('client/inscriptionClient', [
                'validation' => $this->validator,
            ]);
        }
    
        $userModel = new UserModel();
        $data = [
            'CIN' => $this->request->getPost('cin'),
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'role'=>'client',
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];
    
        $userModel->insert($data);
    
        return redirect()->to('/auth/login')->with('success', 'Inscription réussie !');
    }
    


    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
