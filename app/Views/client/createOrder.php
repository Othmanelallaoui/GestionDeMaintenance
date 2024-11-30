<!-- app/Views/admin/createOrder.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Nouvelle Demande</title>
    <link rel="stylesheet" href="<?= base_url('css/createOrder.css') ?>">
</head>

<body>
    <?= view('layout/navbarCli'); ?> 

    <div class="container">
        <h1>Créer une Nouvelle Demande</h1>
        <form action="<?= base_url('/client/storeOrder') ?>" method="POST">
            <?= csrf_field(); ?> 


            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" required>
            </div>

            <div class="form-group">
                <label for="descr">Description :</label>
                <textarea id="descr" name="descr" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="telephone_client">Téléphone :</label>
                <input type="text" id="telephone_client" name="telephone_client" required>
            </div>

            <button type="submit">Créer la Demande</button>
        </form>
    </div>
</body>

</html>
