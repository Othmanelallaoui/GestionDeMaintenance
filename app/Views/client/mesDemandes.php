<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes Demandes</title>
    <link rel="stylesheet" href="<?= base_url('css/mesDemandes.css') ?>">
    <style>
        .hidden {
            display: none;
        }

        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .annuler-btn {
            color: white;
            background-color: red;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .annuler-btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <?= view('layout/navbarCli'); ?>

    <div class="container">
        <h1>Mes Demandes</h1>

      

        <span class="success">
            <?php if (session()->getFlashdata('success')): ?>
                <p><?php echo session()->getFlashdata('success'); ?></p>
            <?php endif; ?>
        </span>

        <?php if (!empty($mesDemandes)): ?>
            <ul class="demandes-list">
                <?php $mesDemandes = array_reverse($mesDemandes); ?>
                <?php foreach ($mesDemandes as $demande): ?>
                    <li class="demande-item <?= strtolower(str_replace(' ', '-', esc($demande['statut']))); ?>">
                        <p class="statut"><strong>Date de création :</strong> <?= esc($demande['date_creation']); ?></p>
                        <h2><?= esc($demande['titre']); ?></h2>
                        <p><?= esc($demande['descr']); ?></p>
                        <p class="statut"><strong>Statut :</strong> <?= esc($demande['statut']); ?></p>

                        <!-- Bouton Annuler visible uniquement si la demande est en attente -->
                        <?php if ($demande['statut'] === 'En attente'): ?>
                            <form action="/client/annulerDemande/<?= esc($demande['id']); ?>" method="POST">
                                <button type="submit" class="annuler-btn" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?')">Annuler la demande</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune demande trouvée.</p>
        <?php endif; ?>
    </div>

    <script>
        function filterDemande(status) {
            let selectedStatus = status || document.getElementById('statusFilter').value;
            let demandes = document.querySelectorAll('.demande-item');

            demandes.forEach(function(demande) {
                let statutClass = demande.className.split(' ').find(c => c !== 'demande-item');

                if (selectedStatus === 'all' || statutClass === selectedStatus) {
                    demande.classList.remove('hidden');
                } else {
                    demande.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>