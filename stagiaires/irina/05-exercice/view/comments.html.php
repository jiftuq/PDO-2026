<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
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
        <?php if ($count === 0): ?>
            <h2 class="section-title">Pas encore de commentaire</h2>
        <?php elseif ($count === 1): ?>
            <h2 class="section-title">Il y a 1 commentaire</h2>
        <?php else: ?>
            <h2 class="section-title">Il y a <?= $count ?> commentaires</h2>
        <?php endif; ?>

        <?php if ($count > 0): ?>
            <section class="comments-list">
                <?php foreach ($comments as $comment): ?>
                    <article class="comment-card">
                        <header>
                            <div>
                                <strong><?= htmlspecialchars($comment['full_name'], ENT_QUOTES, 'UTF-8') ?></strong>
                                <span><?= htmlspecialchars($comment['email'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <span><?= date('d/m/Y H:i', strtotime($comment['post_date'])) ?></span>
                        </header>
                        <h3><?= htmlspecialchars($comment['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= nl2br(htmlspecialchars($comment['text_comment'], ENT_QUOTES, 'UTF-8')) ?></p>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <?php if ($totalPages > 1): ?>
            <nav class="pagination" aria-label="Pagination des commentaires">
                <?php for ($pageIndex = 1; $pageIndex <= $totalPages; $pageIndex++): ?>
                    <a href="?page=commentaires&p=<?= $pageIndex ?>" class="<?= $pageIndex === $currentPage ? 'active' : '' ?>"><?= $pageIndex ?></a>
                <?php endfor; ?>
            </nav>
        <?php endif; ?>

        <div class="page-footer">
            <a href="#top">Retour en haut</a>
            <a class="button" href="?page=ajouter">Ajouter un commentaire</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
