<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigner les Tâches</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboardAdmin.css') ?>">
    <style>
        form {
            width: 100%;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        select,
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        .alert-success {
            color: green;
            font-weight: bold;
        }
       
    </style>
</head>

<body>
    <?= view('layout/navbarAdmin'); ?>

    <div class="container">
        <h1>Assigner des Tâches aux Techniciens</h1>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success"><?= session('success'); ?></div>
        <?php endif; ?>

        <form action="/admin/assigner_tache" method="POST">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label for="demande">Sélectionner une demande :</label>
                <select name="demande_id" id="demande" required>
                    <option value="" disabled selected>Choisir une demande</option>
                    <?php foreach ($demandes as $demande): ?>
                        <option value="<?= esc($demande['id']); ?>"><?= esc($demande['titre']);  ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="technicien">Sélectionner un technicien :</label>
                <select name="technicien_id" id="technicien" required>
                    <option value="" disabled selected>Choisir un technicien</option>
                    <?php foreach ($techniciens as $technicien): ?>
                        <option value="<?= esc($technicien['id']); ?>">
                            <?= esc($technicien['nom']) . ' ' . esc($technicien['prenom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">Assigner la Tâche</button>
        </form>
    </div>
</body>

</html>