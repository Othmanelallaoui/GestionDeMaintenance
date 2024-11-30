<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Demandes</title>
    <link rel="stylesheet" href="<?= base_url('css/gestionDemandes.css') ?>">

</head>

<body>
    <?= view('layout/navbarAdmin'); ?> 

    <div class="container">
        <span>
            <a href="/admin/archive_demandes" class="btn-archive">Archives</a>
        </span>
        <div class="sersh">
            <input type="text" id="searchInput" placeholder="Rechercher par titre, Nom ou Prénom de Client..." class="search-bar" onkeyup="filterTable()">
            <label for="searchInput">Recherche: </label>
        </div>
        <h3>Liste des demandes</h3>

        <?php if (!empty($Demandes)) : ?>
            <table class="demandes-table" id="demandesTable">
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
                            <td><?= esc($demande['nom_client']) . " " . esc($demande['CIN']); ?></td>
                            <td><?= esc($demande['titre']); ?></td>
                            <td class="statut-<?= strtolower(str_replace(' ', '-', $demande['statut'])); ?>">
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

    <script>
        function filterTable() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toUpperCase();
            var table = document.getElementById('demandesTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) {
                var tdClient = tr[i].getElementsByTagName('td')[1]; // Client column (CIN + Name)
                var tdTitre = tr[i].getElementsByTagName('td')[2];  // Titre column
                var tdStatut = tr[i].getElementsByTagName('td')[3]; // Statut column

                if (tdClient || tdTitre || tdStatut) {
                    var txtClient = tdClient.textContent || tdClient.innerText;
                    var txtTitre = tdTitre.textContent || tdTitre.innerText;
                    var txtStatut = tdStatut.textContent || tdStatut.innerText;

                    // If any match is found in CIN, Name, Title or Statut, show row
                    if (txtClient.toUpperCase().indexOf(filter) > -1 || 
                        txtTitre.toUpperCase().indexOf(filter) > -1 || 
                        txtStatut.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
