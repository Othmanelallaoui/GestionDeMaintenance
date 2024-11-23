<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Techniciens</title>
    <link rel="stylesheet" href="<?= base_url('css/gestion_tech.css') ?>">
</head>
<thead>
    <?= view('layout/navbarAdmin'); ?>
</thead>

<body>
    <div class="window"> <?php if (session()->getFlashdata('success')): ?>
            <div class="message-overlay">
                <div class="message-box">
                    <p><?= session()->getFlashdata('success'); ?></p>
                    <form method="post" action="/admin/gestion_technicien">
                        <button type="submit" class="btn-ok">OK</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="message-overlay">
                <div class="message-box">
                    <p><?= session()->getFlashdata('error'); ?></p>
                    <form method="post" action="/admin/gestion_technicien">
                        <button type="submit" class="btn-ok">OK</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
</div>
    <div class="affiche">
        <div class="button-container">
            <a href="/admin/ajouter_technicien" class="btn btn-primary">Ajouter Technicien</a>
        </div>

        <table class="table-style">
            <thead>
                <tr>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($techniciens as $technicien): ?>
                    <tr>
                        <td><?= esc($technicien['CIN']); ?></td>
                        <td><?= esc($technicien['nom']); ?></td>
                        <td><?= esc($technicien['prenom']); ?></td>
                        <td><?= esc($technicien['email']); ?></td>
                        <td><?= esc($technicien['phone']); ?></td>
                        <td>
                            <a href="/technicien/edit/<?= esc($technicien['id']); ?>">Modifier</a> |
                            <a href="/technicien/delete/<?= esc($technicien['id']); ?>">Supprimer</a> |
                            <a href="/admin/reset_password/<?= esc($technicien['id']); ?>" class="btn-warning">Réinitialiser mot de passe</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</body>

</html>