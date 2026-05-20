<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="top">
    <?php include ROOT_PROJECT . "/view/menu.html.php"; ?>
 <main class="container">
        <section class="comments-section">
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
    
        <section class="cta">
            <a href="#top" class="btn btn-secondary">⬆ Retour en haut</a>
            <a href="?page=add" class="btn">Ajouter un commentaire</a>
        </section>
    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
