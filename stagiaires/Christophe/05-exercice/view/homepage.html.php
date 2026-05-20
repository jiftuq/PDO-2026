<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include ROOT_PROJECT . "/view/menu.html.php"; ?>

    <main class="container">
        <h1>Bienvenue sur mon site</h1>

        <section class="about">
            <h2>À propos de moi</h2>
            <p>
                Bonjour, je suis stagiaire en formation Web Développeur au CF2M.
                Ma passion : le code, l'écosystème crypto et tout ce qui touche aux
                technologies du web. J'aime particulièrement construire des outils
                qui résolvent de vrais problèmes pour de vraies personnes.
            </p>
            <p>
                En dehors du code, j'aime explorer Bruxelles, lire de la science-fiction
                et apprendre de nouvelles choses tous les jours.
            </p>
        </section>

        <section class="gallery">
            <figure>
                <img src="https://picsum.photos/seed/1/400/300" alt="Photo 1">
                <figcaption>Bruxelles</figcaption>
            </figure>
            <figure>
                <img src="https://picsum.photos/seed/2/400/300" alt="Photo 2">
                <figcaption>Code</figcaption>
            </figure>
            <figure>
                <img src="https://picsum.photos/seed/3/400/300" alt="Photo 3">
                <figcaption>Lecture</figcaption>
            </figure>
        </section>

        <section class="cta">
            <a href="?page=comments" class="btn">Voir les commentaires</a>
            <a href="?page=add" class="btn btn-secondary">Ajouter un commentaire</a>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
