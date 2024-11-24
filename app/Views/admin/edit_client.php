<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client</title>
    <link rel="stylesheet" href="<?= base_url('css/ajouter_tech.css') ?>">
    <style>h3{
        text-align: center;
        margin-top:10px;
    }
    </style>
</head>

<body>
    <?= view('layout/navbarAdmin'); ?>
    <h3>Mise à jour du client : <?= esc($client['CIN']) ?></h3>

    <div class="container">
        <form action="/client/update/<?= esc($client['id']); ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label for="CIN">CIN:</label>
                <input type="text" id="CIN" value="<?= esc($client['CIN']); ?>" readonly>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= esc(old('nom', $client['nom'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('nom')) : ?>
                        <?= $validation->getError('nom'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= esc(old('prenom', $client['prenom'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('prenom')) : ?>
                        <?= $validation->getError('prenom'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= esc(old('email', $client['email'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('email')) : ?>
                        <?= $validation->getError('email'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" value="<?= esc(old('phone', $client['phone'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('phone')) : ?>
                        <?= $validation->getError('phone'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>

</html>
