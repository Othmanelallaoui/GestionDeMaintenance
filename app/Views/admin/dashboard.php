<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboardAdmin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="container">
        <h1>Tableau de Bord Administrateur</h1>

        <div class="stats-container">
            <div class="stat-card clients">
                <i class="fas fa-users fa-3x"></i>
                <h2>Clients</h2>
                <p><?= $nombreClients; ?></p>
            </div>

            <div class="stat-card techniciens">
                <i class="fas fa-user-cog fa-3x"></i>
                <h2>Techniciens</h2>
                <p><?= $nombreTechniciens; ?></p>
            </div>

            <div class="stat-card techniciens-dispo">
                <i class="fas fa-check-circle fa-3x"></i>
                <h2>Disponibles</h2>
                <p><?= $nombreTechniciensDispo; ?></p>
            </div>

            <div class="stat-card techniciens-indispo">
                <i class="fas fa-times-circle fa-3x"></i>
                <h2>Indisponibles</h2>
                <p><?= $nombreTechniciensIndispo; ?></p>
            </div>

            <div class="stat-card admins">
                <i class="fas fa-user-shield fa-3x"></i>
                <h2>Administrateurs</h2>
                <p><?= $nombreAdmins; ?></p>
            </div>

            <!-- Cartes des demandes -->
            <div class="stat-card demandes-attente">
                <i class="fas fa-clock fa-3x"></i>
                <h2>Demandes en Attente</h2>
                <p><?= $nombreDemandesEnAttente; ?></p>
            </div>

            <div class="stat-card demandes-cours">
                <i class="fas fa-spinner fa-3x"></i>
                <h2>Demandes en Cours</h2>
                <p><?= $nombreDemandesEnCours; ?></p>
            </div>

            <div class="stat-card demandes-terminees">
                <i class="fas fa-check fa-3x"></i>
                <h2>Demandes Terminées</h2>
                <p><?= $nombreDemandesTerminees; ?></p>
            </div>
           
        </div>
    </div>
</body>

</html>
