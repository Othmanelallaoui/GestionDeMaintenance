
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>

    <nav>
        <ul>
            <li><a href="">Gestion Maintenance</a></li>
            <li><a href="#home">Home</a></li>
            <li><a href="#news">News</a></li>
            <li><a href="#contact">Contact</a></li>
            <li style="float:right"><a class="active" href="/logout">logout</a></li>
            <li style="float:right"><a href="/profil" class="profil"><?php echo session()->get('prenom') . " " . session()->get('nom') ?></a></li>

        </ul>
    </nav>

    <h1>welcome <?= session()->get('role')?></h1>

