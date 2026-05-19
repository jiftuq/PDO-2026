<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
    <link rel="stylesheet" href="css/global.css">
</head>
<body id="top">

<header class="site-header">
    <h1>Commentaires</h1>

    <nav class="nav">
        <a href="./">Accueil</a>
        <a href="?page=comments">Commentaires</a>
        <a href="?page=addcomments">Ajouter un commentaire</a>
    </nav>
</header>

<main>
    <?php if (isset($_GET['merci'])): ?>
        <p class="success-message">
            Merci, votre commentaire a bien été ajouté.
        </p>
    <?php endif; ?>

    <?php if ($nbCommentaires === 0): ?>

        <h2>Pas encore de commentaire</h2>

    <?php elseif ($nbCommentaires === 1): ?>

        <h2>Il y a 1 commentaire</h2>

    <?php else: ?>

        <h2>Il y a <?= $nbCommentaires ?> commentaires</h2>

    <?php endif; ?>

    <?php if (!empty($commentaires)): ?>
        <section class="comments-list">
            <?php foreach ($commentaires as $commentaire): ?>
                <article class="commentaire-card">
                    <h3><?= htmlspecialchars($commentaire['title']) ?></h3>

                    <p class="comment-meta">
                        Écrit par <?= htmlspecialchars($commentaire['full_name']) ?>
                        le <?= htmlspecialchars($commentaire['post_date']) ?>
                    </p>

                    <p class="comment-text">
                        <?= htmlspecialchars($commentaire['text_comment']) ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <div class="page-links action-links">
        <a class="button-link" href="#top">Retour en haut</a>
        <a class="button-link" href="?page=addcomments">Ajouter un commentaire</a>
    </div>
</main>

</body>
</html>