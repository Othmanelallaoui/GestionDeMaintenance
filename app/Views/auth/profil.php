<?php

if (!session()->get('is_logged_in') || session()->get('role') !== 'administrateur') {
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
    <title>Profil Administrateur</title>
    <link rel="stylesheet" href="<?= base_url(relativePath: 'css/profil.css') ?>">
</head>

<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="container">
        <h1>Profil de <?= session()->get('nom')?>  <?= session()->get('prenom')?>  </h1>

        <div class="profile-info">
            <p><strong>Nom :</strong> <?= esc($user['nom']); ?></p>
            <p><strong>Prénom :</strong> <?= esc($user['prenom']); ?></p>
            <p><strong>Email :</strong> <?= esc($user['email']); ?></p>
            <p><strong>Téléphone :</strong> <?= esc($user['phone']); ?></p>
        </div>

        <div class="action-buttons">
            <a href="/admin/edit/<?= esc($user['id']); ?>" class="btn-edit">Modifier Profil</a>
        </div>
    </div>
</body>

</html>