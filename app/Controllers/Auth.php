<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index(){
        return view("index");
    }
    public function login()
    {
        return view('auth/login');
    }
    public function loginProcess()
    {
        $model = new UserModel();
    
        try {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
    
            // Essayer de se connecter et récupérer l'utilisateur
            $user = $model->where('email', $email)->first();
    
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session()->set([
                        'user_id' => $user['id'],
                        'prenom' => $user['prenom'],
                        'nom' => $user['nom'],
                        'role' => $user['role'],
                        'is_logged_in' => true
                    ]);
    
                    switch ($user['role']) {
                        case 'administrateur':
                            return redirect()->to('/admin/dashboard');
                        case 'client':
                            return redirect()->to('/client/dashboard');
                        case 'technicien':
                            return redirect()->to('/technicien/dashboard');
                        default:
                            return redirect()->to('/');
                    }
                } else {
                    return redirect()->back()->with('error', 'Mot de passe incorrect');
                }
            } else {
                return redirect()->back()->with('error', 'Aucun utilisateur trouvé');
            }
        } catch (\Throwable $e) {
            // Capture l'erreur de connexion à la base de données
            log_message('error', 'Erreur de base de données : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur de connexion à la base de données. Veuillez réessayer plus tard.');
        }
    }
     
    public function profil(){
        return view('auth/profil');
    }

    public function logout()
    {
        // Déconnecter l'utilisateur
        session()->destroy();
        return redirect()->to('/login');
    }
}
