<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DemandeModel;

use function PHPUnit\Framework\equalTo;

class Client extends BaseController
{

    public function index()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
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
            'role' => 'client',
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $userModel->insert($data);

        return redirect()->to('/auth/login')->with('success', 'Inscription réussie !');
    }
    //---------------------edit--------------------
    public function edit($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $client = $userModel->find($id);

        if (!$client) {
            return redirect()->to('/admin/gestion_clients')->with('error', 'Client non trouvé');
        }

        return view('admin/edit_client', ['client' => $client]);
    }


    //---------------------update--------------------    
    public function update($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $validation = \Config\Services::validation();

        $rules = [
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
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Le champ Email est obligatoire.',
                    'valid_email' => 'L\'adresse email fournie n\'est pas valide.',
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
            $userModel = new UserModel();
            $client = $userModel->find($id);

            return view('admin/edit_client', [
                'validation' => $this->validator,
                'client' => $client
            ]);
        }

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');

        $userModel = new UserModel();



        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'phone' => $phone,
        ];

        $userModel->update($id, $data);

        return redirect()->to('/admin/gestion_clients')->with('success', 'Client mis à jour avec succès');
    }

    //---------------------delete--------------------

    public function delete($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();

        if ($userModel->delete($id)) {
            return redirect()->to('/admin/gestion_clients')->with('success', 'Client supprimé avec succès');
        } else {
            return redirect()->to('/admin/gestion_clients')->with('error', 'Une erreur s\'est produite lors de la suppression');
        }
    }
    //-------------prodil -------------------

    public function profil()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }
        $modeluser = new UserModel();
        $id_user_now = session()->get('user_id');
        $userProfile = $modeluser->find($id_user_now);
        $data = [
            'user' => $userProfile,
        ];
        return view('client/profilCli',$data);
    }


    //------------affichage de form d'ajoute-----------
    public function createOrder()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }
        return view('client/createOrder');
    }

    //---------fonction qui fair enregistrer les demandes dans la DB-----------
    public function store_order()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }
        $demandeModel = new DemandeModel();

        $data = [
            'id_client' => session()->get('user_id'),
            'titre' => $this->request->getPost('titre'),
            'descr' => $this->request->getPost('descr'),
            'telephone_client' => $this->request->getPost('telephone_client'),
            'statut' => 'en attente',
            'id_technicien' => null
        ];

        $demandeModel->insert($data);

        return redirect()->to('/client/mesDemandes')->with('success', 'Demande créée avec succès');
    }

    public function mesDemandes()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }
        $demandeModel = new DemandeModel();

        $clientId = session()->get('user_id');

        $mesDemandes = $demandeModel
            ->where('id_client', $clientId)
            ->orderBy("
                CASE statut
                    WHEN 'annulée' THEN 1
                    WHEN 'refusée' THEN 2
                    WHEN 'terminée' THEN 3
                    WHEN 'en cours' THEN 4
                    WHEN 'en attente' THEN 5
                    ELSE 5
                END", 'ASC')
            ->findAll();

        return view('client/mesDemandes', ['mesDemandes' => $mesDemandes]);
    }

    //--------------- annuler une demande--------
    public function annulerDemande($id)
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }

        $demandeModel = new DemandeModel();

        $demande = $demandeModel->find($id);

        if ($demande && $demande['statut'] === 'En attente') {
            $demandeModel->update($id, ['statut' => 'annulée']);

            session()->setFlashdata('success', 'Votre demande a été annulée avec succès.');
        } else {
            session()->setFlashdata('error', 'Cette demande ne peut pas être annulée.');
        }

        return redirect()->to('/client/mesDemandes');
    }


    public function contact()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }
        return view('client/contact');
    }
    public function contactSend()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $message = $this->request->getPost('message');

        if (!$name || !$email || !$message) {
            session()->setFlashdata('error', 'Tous les champs sont obligatoires.');
            return redirect()->to('/client/contact');
        }

        $emailService = \Config\Services::email();
        $emailService->setTo('nachtindahkin@gmail.com');
        $emailService->setFrom($email, $name);
        $emailService->setSubject('Message de Contact');
        $emailService->setMessage($message);

        if ($emailService->send()) {
            session()->setFlashdata('success', 'Votre message a été envoyé avec succès.');
        } else {
            session()->setFlashdata('error', 'Une erreur est survenue lors de l\'envoi de votre message.');
        }

        return redirect()->to('/client/contact');
    }

    public function updateProfil()
    {
        if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nom'    => 'required|min_length[2]|max_length[50]',
            'prenom' => 'required|min_length[2]|max_length[50]',
            'email'  => 'required|valid_email',
            'phone'  => 'required|numeric|min_length[10]|max_length[10]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nom'    => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email'  => $this->request->getPost('email'),
            'phone'  => $this->request->getPost('phone'),
        ];

        $userModel = new UserModel();
        $userId = session()->get('user_id'); 

        if ($userModel->update($userId, $data)) {
            session()->set([
                'user_id' =>  $userId,
                'prenom' => $this->request->getPost('prenom'),
                'nom' => $this->request->getPost('nom'),
            ]);
            return redirect()->to('/client/profil')->with('success', 'Profil mis à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }








    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
