<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="bar">
            <a class="site-title" href="?">Exercice 5</a>
            <button class="menu-toggle" type="button">☰ Menu</button>
            <nav class="site-navigation" aria-label="Navigation principale">
                <a href="?" class="<?= empty($_GET['page']) ? 'active' : '' ?>">Accueil</a>
                <a href="?page=commentaires" class="<?= ($_GET['page'] ?? '') === 'commentaires' ? 'active' : '' ?>">Commentaires</a>
                <a href="?page=ajouter" class="<?= ($_GET['page'] ?? '') === 'ajouter' ? 'active' : '' ?>">Ajouter un commentaire</a>
            </nav>
        </div>
    </header>

    <main id="top" class="container">
        <h2 class="section-title">Ajouter un commentaire</h2>

        <?php if (!empty($errors)): ?>
            <div class="error-summary">
                <strong>Le formulaire contient des erreurs :</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-card">
            <form id="comment-form" action="?page=ajouter" method="post" novalidate>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" maxlength="120" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-field">
                    <label for="full_name">Nom complet</label>
                    <input id="full_name" type="text" name="full_name" minlength="5" maxlength="120" value="<?= htmlspecialchars($old['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-field">
                    <label for="title">Titre</label>
                    <input id="title" type="text" name="title" minlength="5" maxlength="180" value="<?= htmlspecialchars($old['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
                <div class="form-field">
                    <label for="text_comment">Commentaire</label>
                    <textarea id="text_comment" name="text_comment" minlength="5" maxlength="1000" required><?= htmlspecialchars($old['text_comment'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                    <small>Minimum 5 caractères, maximum 1000 caractères.</small>
                </div>
                <button class="button" type="submit">Publier</button>
            </form>
        </div>

        <div class="page-footer">
            <a href="?page=commentaires">Voir les commentaires</a>
            <a href="#top">Retour en haut</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
