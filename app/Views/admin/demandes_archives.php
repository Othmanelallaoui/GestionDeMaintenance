<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Archives des Demandes</title>
    <link rel="stylesheet" href="<?= base_url('css/gestionDemandes.css') ?>">

</head>

<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="container">
        <span>
            <a href="/admin/gestion_demandes" class="btn-archive">Demandes </a>
        </span>

        <h3>Liste des demandes archivées</h3>

        <?php if (!empty($Demandes)) : ?>
            <table class="demandes-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Demandes as $demande) : ?>
                        <tr>
                            <td><?= esc($demande['id']); ?></td>
                            <td><?= esc($demande['nom_client']) . " (" . esc($demande['CIN']) . ")"; ?></td>
                            <td><?= esc($demande['titre']); ?></td>
                            <td class="statut-<?= strtolower(str_replace(' ', '-', esc($demande['statut']))); ?>">
                                <?= esc($demande['statut']); ?>
                            </td>
                            <td><?= esc($demande['date_creation']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucune demande trouvée.</p>
        <?php endif; ?>
    </div>
</body>

</html>