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
        <div class="container header-inner">
            <div class="brand">Mon site</div>
            <button class="menu-toggle" aria-label="Menu" aria-expanded="false">☰</button>
            <nav class="main-nav" aria-label="Main navigation">
                <ul>
                    <li><a href="?page=home">Accueil</a></li>
                    <li><a href="?page=comments">Commentaires</a></li>
                    <li><a href="?page=add">Ajouter un commentaire</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="comments">
            <h1>Commentaires</h1>
            <?php if(!empty($commentaires) && is_array($commentaires)): ?>
                <ul class="comment-list">
                <?php foreach($commentaires as $c): ?>
                    <li class="comment-item">
                        <h3><?php echo htmlspecialchars($c['title'] ?? 'Sans titre'); ?></h3>
                        <p class="meta">Par <?php echo htmlspecialchars($c['email'] ?? 'anonyme'); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($c['text_comment'] ?? $c['text'] ?? '')); ?></p>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun commentaire pour le moment.</p>
            <?php endif; ?>
            <p><a class="btn" href="?page=add">Ajouter un commentaire</a></p>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
