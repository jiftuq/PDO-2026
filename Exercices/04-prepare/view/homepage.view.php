<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
<?php
// var_dump($_POST);
?>
    <div class="container">
        <h1>📖 Livre d'or</h1>

        <div class="form-box">
            <form method="POST" action="">

                <div class="form-group">
                    <label for="email">Votre Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="title">Votre title :</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="text">Votre Commentaire :</label>
                    <textarea id="text" name="text" required></textarea>
                </div>

                <button type="submit" class="btn">Laisser un Commentaire</button>
            </form>
        </div>

            <div class="message"><?= $livres ?></div>
            <div class="comments">Nombre de commentaires :
    </div>
    <div class="comments-list">
            <div class="commentaires-utilisateur">
                <h3></h3>
                <p></p>
                <p></p>
            </div>
    </div>
</body>

</html>