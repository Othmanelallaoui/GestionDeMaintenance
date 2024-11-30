<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 10px;
        }

        .signup {
            text-align: center;
        }

        .signup a {
            color: #4CAF50;
             text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <span class="error">
        <?php if (session()->getFlashdata('error')): ?>
            <p style="color:red;"><?php echo session()->getFlashdata('error'); ?></p>
        <?php endif; ?>
        </span>
        <form  action="/auth/loginProcess" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <div class="forgot-password">
                <a href="#">Mot de passe oublié?</a>
            </div>
            <button type="submit">Se connecter</button>
            <div class="signup">
                <p>Vous êtes un client ? <a href="/auth/registerClient">Créer un nouveau compte</a></p>
            </div>
        </form>
    </div>
</body>
</html>