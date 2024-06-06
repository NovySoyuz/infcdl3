<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="../web/css/formulaire.css">
</head>

<body>
    <header>
        <nav>
            <a href="login.php" class="login"><button type="submit">Se connecter</button></a>
        </nav>
    </header>

    <div class="container">
        <form action="?action=login" method="POST">
            <h2>Connexion</h2>

            <div class="groupe">
                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo" required>

            </div>

            <div class="groupe">
                <label for="pseudo">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

            </div>

            <?php

            if (isset($errorMsg)) {
                echo "<div class='alert-warning'>$errorMsg</div>";
            }
            ?>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>

</html>