<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include ROOT_PROJECT . "/view/menu.html.php"; ?>

    <main class="container">
        <h1>Ajouter un commentaire</h1>

        <?php
        // si $insert est défini et false, c'est qu'il y a eu une erreur
        if (isset($insert) && $insert === false):
        ?>
            <div class="alert alert-error">
                <strong>Le formulaire contient des erreurs :</strong>
                <ul>
                    <li>Email valide et max 120 caractères</li>
                    <li>Nom complet : entre 5 et 120 caractères</li>
                    <li>Titre : entre 5 et 180 caractères</li>
                    <li>Commentaire : entre 5 et 1000 caractères</li>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="?page=add" class="form-box" id="comment-form" novalidate>

            <div class="form-group">
                <label for="email">Email <span class="req">*</span></label>
                <input type="email" id="email" name="email" maxlength="120"
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                <small>Max 120 caractères</small>
            </div>

            <div class="form-group">
                <label for="fullName">Nom complet <span class="req">*</span></label>
                <input type="text" id="fullName" name="fullName" minlength="5" maxlength="120"
                       value="<?= isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : '' ?>" required>
                <small>Entre 5 et 120 caractères</small>
            </div>

            <div class="form-group">
                <label for="title">Titre <span class="req">*</span></label>
                <input type="text" id="title" name="title" minlength="5" maxlength="180"
                       value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>" required>
                <small>Entre 5 et 180 caractères</small>
            </div>

            <div class="form-group">
                <label for="text_comment">Commentaire <span class="req">*</span></label>
                <textarea id="text_comment" name="text_comment" minlength="5" maxlength="1000" required><?= isset($_POST['text_comment']) ? htmlspecialchars($_POST['text_comment']) : '' ?></textarea>
                <small>Entre 5 et 1000 caractères</small>
            </div>

            <button type="submit" class="btn">Publier le commentaire</button>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
