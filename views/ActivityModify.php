<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le commentaire</title>
    <link rel="stylesheet" href="../web/css/formulaire.css">
</head>

<body>

    <div class="container">
        <form action="?action=modifyMsg" method="POST">
            <h2>Modifier le message</h2>
            <div class="groupe">
                <label for="content">Rentrer votre message :</label>
                <input type="text" id="content" name="content" value="<?php echo htmlspecialchars($_GET['content']); ?>" required>
            </div>
            <input type="hidden" name="id_post" value="<?php echo htmlspecialchars($_GET['id_post']); ?>"> <!-- passe en caché id_post qui est envoyé au serveur (POST) avec le formulaire pour pouvoir l'utiliser dans le controller -->
            <button type="submit">Poster</button>
        </form>
    </div>
</body>

</html>