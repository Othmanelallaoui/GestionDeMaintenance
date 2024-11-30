
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-color: #E4E0E1;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        font-size: 14px;
        margin-left: 20%;
    }

    nav {
        background-color: #004D40;  
        color: white;
    }

    

    li {
        float: left;
    }

    li a, .dropbtn {
        display: block;
        color: white;
        text-align: center;
        padding: 12px 16px;
        text-decoration: none;
    }

    li a:hover, .dropdown:hover .dropbtn {
        background-color: #00796B;  /* Vert sarcelle */
    }

    .dropdown {
        float: right;
        overflow: hidden;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #455A64;  /* Gris anthracite */
        min-width: 160px;
        z-index: 1;
        right: 0;
    }

    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #00796B;  
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .profil:hover {
        background-color: #00796B;  
        text-decoration: underline;
    }

    img {
        width: 45px;
        height: 37px;
    }

    li.right {
        float: right;
    }
</style>



    <nav>
        <ul>
        <li><a href="/technicien/dashboard" class="active">Accueil</a></li>
        <li><a href="/technicien/mes_taches">Mes Taches</a></li>
            <li><a href="/technicien/mes_taches_terminees">Taches Terminer</a></li>
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
    </nav>

