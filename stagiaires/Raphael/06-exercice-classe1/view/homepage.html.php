<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mugs personnalisés</title>
    <link rel="stylesheet" href="css/global.css">
</head>
<body id="top">

<header class="site-header">
    <h1>Mes mugs personnalisés</h1>

    <nav class="nav">
        <a href="./">Accueil</a>
        <a href="?page=comments">Commentaires</a>
        <a href="?page=addcomments">Ajouter un commentaire</a>
    </nav>
</header>

<main>
    <div class="container">
        <div class="card">
            <img src="img/red.png" alt="Personnage rouge pour mug personnalisé">
            <p>Mug rouge</p>
        </div>

        <div class="card">
            <img src="img/green.png" alt="Personnage vert pour mug personnalisé">
            <p>Mug vert</p>
        </div>

        <div class="card">
            <img src="img/yellow.png" alt="Personnage jaune pour mug personnalisé">
            <p>Mug jaune</p>
        </div>
    </div>

    <p class="page-intro">
        Ma passion est de collectionner des mugs personnalisés avec des personnages
        de style anime. J’aime les designs colorés, les personnages originaux et
        les tasses qui ont chacune une ambiance différente.
    </p>

    <section class="comment-summary">
        <?php if ($nbCommentaires === 0): ?>

            <h2>Pas encore de commentaire</h2>

        <?php elseif ($nbCommentaires === 1): ?>

            <h2>Il y a 1 commentaire</h2>

        <?php else: ?>

            <h2>Il y a <?= $nbCommentaires ?> commentaires</h2>

        <?php endif; ?>

        <div class="action-links">
            <a class="button-link" href="?page=comments">Voir les commentaires</a>
            <a class="button-link" href="?page=addcomments">Ajouter un commentaire</a>
        </div>
    </section>
</main>

</body>
</html>