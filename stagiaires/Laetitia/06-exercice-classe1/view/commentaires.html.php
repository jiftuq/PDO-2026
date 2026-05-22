<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Commentaires</title>
</head>
<body>

    <nav>
        <div class="nav-inner">
            <a href="index.php" class="nav-logo">🎹 Ma Passion</a>

            <ul class="nav-links" id="navLinks">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?page=commentaires" class="active">Commentaires</a></li>
                <li><a href="index.php?page=add_commentaire">Ajouter un commentaire</a></li>
            </ul>

            <div style="display:flex; align-items:center; gap:0.5rem;">
                <button class="theme-toggle" id="themeToggle" title="Changer le thème">
                    <span class="icon-moon">🌙</span>
                    <span class="icon-sun">☀️</span>
                </button>
                <button class="hamburger" id="hamburger" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <main id="top">

        <?php if (!empty($flash_success)): ?>
            <div class="flash flash-success">
                🎉 <?= htmlspecialchars($flash_success) ?>
            </div>
        <?php endif; ?>

        <div class="page-header">
            <?php if ($nb_commentaires == 0): ?>
                <h1>Pas encore de commentaire</h1>
                <p>Soyez le premier à laisser un commentaire !</p>
            <?php elseif ($nb_commentaires == 1): ?>
                <h1>Il y a 1 commentaire</h1>
            <?php else: ?>
                <h1>Il y a <?= $nb_commentaires ?> commentaires</h1>
            <?php endif; ?>
        </div>

        <?php if (!empty($commentaires)): ?>
            <?php foreach ($commentaires as $c): ?>
                <article class="comment-card">
                    <div class="comment-card-header">
                        <div class="comment-card-meta">
                            <span class="comment-author">👤 <?= htmlspecialchars($c['full_name']) ?></span>
                            <span class="comment-email">✉️ <?= htmlspecialchars($c['email']) ?></span>
                        </div>
                        <span class="comment-date">
                            🗓️ <?= date('d/m/Y à H:i', strtotime($c['post_date'])) ?>
                        </span>
                    </div>
                    <p class="comment-title"><?= htmlspecialchars($c['title']) ?></p>
                    <p class="comment-body"><?= nl2br(htmlspecialchars($c['text_comment'])) ?></p>
                </article>
            <?php endforeach; ?>

            <?php if (!empty($total_pages) && $total_pages > 1): ?>
                <div class="pagination">
                    <?php if ($page_courante > 1): ?>
                        <a href="index.php?page=commentaires&p=<?= $page_courante - 1 ?>">&#8592;</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php if ($i == $page_courante): ?>
                            <span class="current"><?= $i ?></span>
                        <?php else: ?>
                            <a href="index.php?page=commentaires&p=<?= $i ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($page_courante < $total_pages): ?>
                        <a href="index.php?page=commentaires&p=<?= $page_courante + 1 ?>">&#8594;</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <div class="page-footer-links">
            <a href="#top" class="back-to-top">⬆️ Retour en haut</a>
            <a href="index.php?page=add_commentaire" class="btn btn-primary">✏️ Ajouter un commentaire</a>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
