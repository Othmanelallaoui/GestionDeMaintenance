<link rel="stylesheet" href="<?= base_url('css/navbarAdmin.css') ?>">

    <nav>
        <ul id="menu">
            <!-- Logo -->
            <li><img src="<?php echo base_url('images/logo.png') ?>" alt="logo"></li>
            <li><a href="/admin/dashboard">Accueil</a></li>
            <li><a href="/admin/gestion_technicien">Gestion Techniciens</a></li>
            <li><a href="/admin/gestion_demandes">Gestion des demandes</a></li>
            <li><a href="/admin/assigner_taches_technicien">Assigner les tâches</a></li>
            <li><a href="/admin/gestion_clients">Gestion des Clients</a></li>
            <li><a href="/admin/reclamations">Réclamations</a></li>
            
            <!-- Dropdown pour Profil et Logout -->
            <li class="dropdown right">
                <a href="javascript:void(0)" class="dropbtn">
                    <?php echo session()->get('prenom') . " " . session()->get('nom') ?>
                    <span class="arrow-down">▼</span>
                </a>

                <div class="dropdown-content">
                    <a href="/admin/profil">Profil</a>
                    <a href="/logout">Logout</a>
                </div>
            </li>
        </ul>

        <!-- Menu icon (burger menu) -->
    
    </nav>

   

