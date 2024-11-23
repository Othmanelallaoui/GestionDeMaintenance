<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>

<body>
    <div class="divform">
        <h2>Connexion</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <p style="color:red;"><?php echo session()->getFlashdata('error'); ?></p>
        <?php endif; ?>
        <form action="/auth/loginProcess" method="post">
            <label>Email :</label>
            <input type="email" name="email" required>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>

        <!-- Option de création de compte pour les clients -->
        <p>Vous êtes un client ? <a href="/auth/registerClient">Créer un nouveau compte</a></p>
    </div>
</body>

</html>