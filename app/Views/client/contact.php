<?php

if (!session()->get('is_logged_in') || session()->get('role') !== 'client') {
    return redirect()->to('/login');
}

use App\Models\UserModel;

$userModel = new UserModel();
$user = $userModel->find(session()->get('user_id'));
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="<?= base_url('css/contact.css') ?>">
    <style>
        .contact-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 10px;
        }

        .contact-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .contact-form button {
            width: 100%;
            padding: 10px;
            background-color: #f0a500;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?= view('layout/navbarCli'); ?>

    <div class="contact-form-container">
        <div class="contact-form">
            <h2>Contactez-nous</h2>
            <form action="/client/contactSend" method="POST">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?= esc($user['nom']), " ", esc($user['prenom']) ?>" readonly>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= esc($user['email']) ?>" readonly>

                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Envoyer</button>
            </form>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="message success">
                    <p><?= session()->getFlashdata('success'); ?></p>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="message error">
                    <p><?= session()->getFlashdata('error'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>