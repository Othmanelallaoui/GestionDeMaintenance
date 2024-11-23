<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Client</title>
    <link rel="stylesheet" href="<?= base_url('css/inscription_client.css') ?>">
</head>

<body>
    <div class="divform">
        <?php if (session()->getFlashdata('error')): ?>
            <p style="color:red;"><?php echo session()->getFlashdata('error'); ?></p>
        <?php endif; ?>

        <form action="/client/store" method="post">
            <h3>Inscription Client</h3>

            <label>CIN :</label>
            <input type="text" name="cin" value="<?= old('cin') ?>">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('cin')) echo $validation->getError('cin') ?></span>

            <label>Nom :</label>
            <input type="text" name="nom" value="<?= old('nom') ?>">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('nom')) echo $validation->getError('nom') ?></span>

            <label>Prénom :</label>
            <input type="text" name="prenom" value="<?= old('prenom') ?>">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('prenom')) echo $validation->getError('prenom') ?></span>

            <label>Email :</label>
            <input type="email" name="email" value="<?= old('email') ?>">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('email')) echo $validation->getError('email') ?></span>

            <label for="phone">Téléphone:</label>
            <input type="text" name="phone" id="phone" value="<?= old('phone') ?>">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('phone')) echo $validation->getError('phone') ?></span>

            <label>Mot de passe :</label>
            <input type="password" name="password">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('password')) echo $validation->getError('password') ?></span>

            <label>Confirmer le mot de passe :</label>
            <input type="password" name="confirm_password">
            <span class="error-message"><?php if (isset($validation) && $validation->hasError('confirm_password')) echo $validation->getError('confirm_password') ?></span>
            <div class="clas1">
                <button type="submit">S'inscrire</button>
                <p>Vous avez déjà un compte ? <a href="/auth/login">Se connecter</a></p>
            </div>
        </form>

    </div>
</body>

</html>