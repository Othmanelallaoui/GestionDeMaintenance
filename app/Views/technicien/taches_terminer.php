<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Tâches Terminées</title>
    <link rel="stylesheet" href="<?= base_url('css/mes_taches.css') ?>"> 
</head>
<body>
    <?= view('layout/navbar'); ?>

    <div class="container">
        <h2>Mes Tâches Terminées :</h2>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php elseif (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="cards-container">
            <?php if (!empty($taches)) : ?>
                <?php foreach ($taches as $tache) : ?>
                    <div class="card">
                        <h3><?= esc($tache['titre']) ?></h3>
                        <p><strong>Description :</strong> <?= esc($tache['descr']) ?></p>
                        <p><strong>Statut :</strong> <?= esc($tache['statut']) ?></p>
                        <p><strong>Date d'assignation :</strong> <?= esc($tache['date_creation']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune tâche terminée pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
