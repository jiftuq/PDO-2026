<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="bar">
            <a class="site-title" href="?">Exercice 5</a>
            <button class="menu-toggle" type="button">☰ Menu</button>
            <nav class="site-navigation" aria-label="Navigation principale">
                <a href="?" class="active">Accueil</a>
                <a href="?page=commentaires">Commentaires</a>
                <a href="?page=ajouter">Ajouter un commentaire</a>
            </nav>
        </div>
    </header>

    <main class="hero">
        <section>
            <h1>Bienvenue sur mon espace</h1>
            <p>J'adore explorer le développement web, la création d'interfaces adaptatives et les bonnes pratiques PHP. Ce projet présente un mini-site responsive avec commentaires, validation backend et frontend, et navigation conviviale.</p>

            <div class="cta-group">
                <a class="button" href="?page=commentaires">Voir les commentaires</a>
                <a class="button-secondary" href="?page=ajouter">Ajouter un commentaire</a>
            </div>
        </section>

        <section class="cards">
            <figure class="card">
                <img src="img/photo1.svg" alt="Exemple de photo 1">
                <figcaption>Passion pour le code et l'apprentissage continu.</figcaption>
            </figure>
            <figure class="card">
                <img src="img/photo2.svg" alt="Exemple de photo 2">
                <figcaption>Design épuré, interfaces responsives et UX moderne.</figcaption>
            </figure>
            <figure class="card">
                <img src="img/photo3.svg" alt="Exemple de photo 3">
                <figcaption>Une expérience front-end et PHP maîtrisée.</figcaption>
            </figure>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
