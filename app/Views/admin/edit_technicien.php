<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Technicien</title>
    <link rel="stylesheet" href="<?= base_url('css/ajouter_tech.css') ?>">
   
</head>

<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="container">
        <form action="/technicien/update/<?= esc($technicien['id']); ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label for="CIN">CIN:</label>
                <input type="text" id="CIN" value="<?= esc($technicien['CIN']); ?>" readonly>
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= esc(old('nom', $technicien['nom'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('nom')) : ?>
                        <?= $validation->getError('nom'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= esc(old('prenom', $technicien['prenom'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('prenom')) : ?>
                        <?= $validation->getError('prenom'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= esc(old('email', $technicien['email'])); ?>">
                <span class="error-message">
                    <?php if (isset($validation) && $validation->hasError('email')) : ?>
                        <?= $validation->getError('email'); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" value="<?= esc(old('phone', $technicien['phone'])); ?>">
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