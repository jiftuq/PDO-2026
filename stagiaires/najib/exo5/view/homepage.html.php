<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
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

    <main id="home" class="container">
        <section class="intro">
            <h1>Bonjour — Bienvenue sur ma page</h1>
            <p>Je m'appelle Najib. Je suis passionné par les jeux video et le développement . J'aime capturer des instants, apprendre de nouvelles technologie.</p>

            <div class="photos">
                <img src="img/1736331549-8499-card.webp" alt="Photo 1">
                <img src="img/Co-Streaming-4.png" alt="Photo 2">
                <img src="img/raw.jpg" alt="Photo 3">
            </div>

            <div class="links-row">
                <a class="btn" href="?page=comments">Voir les commentaires</a>
                <a class="btn outline" href="?page=add">Ajouter un commentaire</a>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>