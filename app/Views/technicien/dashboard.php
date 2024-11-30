<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technicien Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboardTech.css') ?>"> 

   
</head>

<body>
    <!-- Navbar -->
    <?= view('layout/navbar'); ?>

    <div class="cont">
        <!-- Carte d'information -->
        <div class="card">
            <p>Nombre de tâches assignées : <span class="highlight"><?= $nombreTaches ?></span></p>
            <p>ID de l'utilisateur : <span class="highlight"><?= $id_user ?></span></p>
            <p>Nom de l'utilisateur : <span class="highlight"><?= $user['nom'] ?></span></p>

            <p>Disponibilité : <span class="highlight"><?= $dispo ?></span></p>

            <!-- Bouton pour modifier la disponibilité -->
            <form action="/technicien/modifier-disponibilite" method="POST">
                <input type="hidden" name="id_user" value="<?= $id_user ?>">
                <label for="dispo">Changer la disponibilité :</label>
                <select name="dispo" id="dispo">
                    <option value="disponible" <?= $dispo === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                    <option value="indisponible" <?= $dispo === 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
                </select>
                <button type="submit">Modifier</button>
            </form>
        </div>

    </div>
</body>

</html>