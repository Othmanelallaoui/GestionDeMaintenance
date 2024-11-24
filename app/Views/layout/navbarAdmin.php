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
        background-color: #AB886D;
        font-size: 14px;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 12px 6px;
        text-decoration: none;

    }

    li a:hover {
        background-color: #8B5E3C;
    }

    .profil:hover {
        background-color: #A67B5B;
        text-decoration: underline;

    }
    img{
        width:45px;
        height:37px;
    }
</style>

<nav>
    <ul>
        <li><img src="<?php echo base_url('images/logo.png') ?>" alt="logo"></li>
        <li><a href="/admin/dashboard">Accueille</a></li>
        <li><a href="/admin/gestion_technicien">Gestion Techniciens</a></li>
        <li><a href="#news">Gestion des demandes</a></li>
        <li><a href="/admin/gestion_client">Gestion des Clients</a></li>
        <li><a href="#contact">Reclamations</a></li>

        <li style="float:right"><a class="active" href="/logout">logout</a></li>
        <li style="float:right"><a href="/admin/profil" class="profil"><?php echo session()->get('prenom') . " " . session()->get('nom') ?></a></li>
    </ul>
</nav>