<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
    <link rel="stylesheet" href="<?= base_url('css/gestion_tech.css') ?>">
    <script src="<?= base_url('js/search.js') ?>"></script>
<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="window">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="message-overlay">
                <div class="message-box">
                    <p><?= session()->getFlashdata('success'); ?></p>
                    <form method="post" action="/admin/gestion_clients">
                        <button type="submit" class="btn-ok">OK</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="message-overlay">
                <div class="message-box">
                    <p><?= session()->getFlashdata('error'); ?></p>
                    <form method="post" action="/admin/gestion_clients">
                        <button type="submit" class="btn-ok">OK</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="affiche">
        <div class="button-container">
            <a href="/admin/ajouter_client" class="btn btn-primary">Ajouter Client</a>
        </div>
        <div class="sersh">
            <input type="text" id="searchInput" placeholder="Rechercher par CIN, Nom ou Prénom..." class="search-bar" onkeyup="filterTable()">
            <label for="">Recherche: </label>
        </div>
        <h3>List des clients</h3>

        <table class="table-style" id="TableRow">
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
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= esc($client['CIN']); ?></td>
                        <td><?= esc($client['nom']); ?></td>
                        <td><?= esc($client['prenom']); ?></td>
                        <td><?= esc($client['email']); ?></td>
                        <td><?= esc($client['phone']); ?></td>
                        <td>
                            <a href="/client/edit/<?= esc($client['id']); ?>">Modifier</a> |
                            <a href="/client/delete/<?= esc($client['id']); ?>">Supprimer</a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>