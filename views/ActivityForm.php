<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentrer un commentaire</title>
    <link rel="stylesheet" href="../web/css/formulaire.css">
</head>

<body>

    <div class="container">
        <form action="?action=newMsg" method="POST">
            <h2>Inscription</h2>
        
            <div class="groupe">
                <label for="content">Rentrer votre message :</label>
                <input type="text" id="content" name="content" required>

            </div>

            <button type="submit">Poster</button>
        </form>
    </div>
</body>

</html>