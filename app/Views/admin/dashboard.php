<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
</head>

<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="container">
        <h1>Tableau de Bord</h1>

        <div class="stats-container">
            <div class="stat-box clients">
                <h2>Clients</h2>
                <p><?= $nombreClients; ?></p>
            </div>
            <div class="stat-box techniciens">
                <h2>Techniciens</h2>
                <p><?= $nombreTechniciens; ?></p>
            </div>
            <div class="stat-box admins">
                <h2>Administrateurs</h2>
                <p><?= $nombreAdmins; ?></p>
            </div>
        </div>
    </div>

    <!-- Style CSS pour le tableau de bord -->
    <style>
        .container {
            text-align: center;
            padding: 20px;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
        }

        .stat-box {
            width: 200px;
            padding: 20px;
            border-radius: 15px;
            color: #fff;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .clients {
            background-color: #6F4E37;  /* Marron */
        }

        .techniciens {
            background-color: #5A9BD5; /* Bleu */
        }

        .admins {
            background-color: #70AD47;  /* Vert */
        }

        .stat-box h2 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .stat-box p {
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</body>

</html>
