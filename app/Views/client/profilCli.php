<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client</title>
    <link rel="stylesheet" href="<?= base_url('css/profilCli.css') ?>">
    <style>
        .alert {
    padding: 6px;
    margin-bottom: 10px;
    border-radius: 5px;
    text-align: start;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}


        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <?= view('layout/navbarCli'); ?>

    <div class="container">
        <h2>Profil de <?= session()->get('prenom') ?> <?= session()->get('nom') ?></h2>

        <!-- Affichage des messages de succès ou d'erreur -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <form action="/client/updateProfil" method="POST">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= old('nom', esc($user['nom'])); ?>" required>
                <?php if (session()->has('errors') && session('errors.nom')): ?>
                    <div class="error-message"><?= session('errors.nom'); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= old('prenom', esc($user['prenom'])); ?>" required>
                <?php if (session()->has('errors') && session('errors.prenom')): ?>
                    <div class="error-message"><?= session('errors.prenom'); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= old('email', esc($user['email'])); ?>" required>
                <?php if (session()->has('errors') && session('errors.email')): ?>
                    <div class="error-message"><?= session('errors.email'); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="tel" id="phone" name="phone" value="<?= old('phone', esc($user['phone'])); ?>" required>
                <?php if (session()->has('errors') && session('errors.phone')): ?>
                    <div class="error-message"><?= session('errors.phone'); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="cin">CIN :</label>
                <input type="text" id="cin" name="cin" value="<?= esc($user['CIN']); ?>" readonly>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn-edit">Modifier Profil</button>
            </div>
        </form>

    </div>
</body>

</html>