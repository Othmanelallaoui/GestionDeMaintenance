<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter Technicien</title>
    <link rel="stylesheet" href="<?= base_url('css/ajouter_tech.css') ?>">
</head>

<body>
    <?= view('layout/navbarAdmin'); ?>
    <div class="container">
        <h2>Ajouter un Technicien</h2>

        <form action="/admin/store_technicien" method="post">
            <div class="form-group">
                <label for="CIN">CIN</label>
                <input type="text" name="CIN" id="CIN" class="form-control" placeholder="XX12345    ">
                <span class="error-message"><?php if (isset($validation) && $validation->hasError('CIN')) echo $validation->getError('CIN') ?></span>
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="lastname">
                <span class="error-message"><?php if (isset($validation) && $validation->hasError('nom')) echo $validation->getError('nom') ?></span>

            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" placeholder=firsname>
                <span class="error-message"><?php if (isset($validation) && $validation->hasError('prenom')) echo $validation->getError('prenom') ?></span>

            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@exemple.com">
                <span class="error-message"><?php if (isset($validation) && $validation->hasError('email')) echo $validation->getError('email') ?></span>

            </div>
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="0700000000 / 0600000000">
                <span class="error-message"><?php if (isset($validation) && $validation->hasError('phone')) echo $validation->getError('phone') ?></span>

            </div>
         

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>

</html>