<link rel="stylesheet" href="<?= base_url('css/navbarCli.css') ?>">

<nav>
    <ul>
        <li><a href="#">Gestion Maintenance</a></li>
        <li><a href="/client/createOrder">Créer une Demande</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Mes Demandes ▼</a>
            <div class="dropdown-content">
                <a href="/client/mesDemandes" onclick="filterDemande('all')">Tous</a>
                <a href="#" onclick="filterDemande('en-attente')">En Attente</a>
                <a href="#" onclick="filterDemande('en-cours')">En Cours</a>
                <a href="#" onclick="filterDemande('terminée')">Terminée</a>
                <a href="#" onclick="filterDemande('refusée')">Refusée</a>
                <a href="#" onclick="filterDemande('annulée')">Annulée</a>

            </div>
        </li>
        <li><a href="/client/contact">Contactez-nous</a></li>





        <li class="dropdown right">
            <a href="javascript:void(0)" class="dropbtn">
                <?php echo session()->get('prenom') . " " . session()->get('nom') ?>
                <span class="arrow-down">▼</span>

            </a>

            <div class="dropdown-content">
                <a href="/client/profil">Profil</a>
                <a href="/logout">Logout</a>
            </div>
        </li>

    </ul>
</nav>