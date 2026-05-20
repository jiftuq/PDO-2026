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
        <section class="add-comment">
            <h1>Ajouter un commentaire</h1>
            <form method="post" action="" class="comment-form">
                <label>Email<br>
                    <input type="email" name="email" required>
                </label>
                <label>Titre<br>
                    <input type="text" name="title" required>
                </label>
                <label>nom Compelt<br>
                    <input type="text" name="fullName" required>
                </label>
                <label>Message<br>
                    <textarea name="text_comment" rows="6" required></textarea>
                </label>
                <button type="submit" class="btn">Envoyer</button>
            </form>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
