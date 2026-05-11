<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">

        <h1>📖 Livre d'or</h1>

        <?php
        // Après soumission du formulaire, on affiche un message de retour
        if (isset($insert) && $insert === true) {
        ?>
            <button class="btn-valid">Merci pour votre commentaire !</button>
        <?php
        } elseif (isset($insert) && $insert === false) {
        ?>
            <button class="btn-unvalid">Votre commentaire n'est pas valide</button>
        <?php
        }
        ?>

        <!-- Formulaire d'ajout de commentaire -->
        <div class="form-box">
            <form method="POST" action="">

                <div class="form-group">
                    <label for="email">Votre Email :</label>
                    <input type="text" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="title">Votre Titre :</label>
                    <input type="text" id="title" name="title">
                </div>

                <div class="form-group">
                    <label for="text">Votre Commentaire :</label>
                    <textarea id="text" name="text"></textarea>
                </div>

                <button type="submit" class="btn">Laisser un Commentaire</button>
            </form>
        </div>

        <!-- Nombre total de commentaires -->
        <div class="comments">
            <?php
            if ($total_commentaires === 0) {
                echo "Pas encore de commentaire";
            } elseif ($total_commentaires === 1) {
                echo "Il y a 1 commentaire";
            } else {
                echo "Il y a " . $total_commentaires . " commentaires";
            }
            ?>
        </div>

        <!-- Liste des commentaires de la page actuelle -->
        <div class="comments-list">
            <?php
            // On boucle sur chaque commentaire récupéré depuis la base
            foreach ($livres as $livre) {
            ?>
                <div class="commentaires-utilisateur">
                    <h3><?= htmlspecialchars($livre['title']) ?></h3>
                    <p><?= htmlspecialchars($livre['text']) ?></p>
                    <p><em><?= htmlspecialchars($livre['email']) ?> — <?= $livre['datetime'] ?></em></p>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Pagination : on affiche les liens uniquement s'il y a plus d'une page -->
        <?php if ($nb_pages > 1) { ?>
        <div class="pagination">

            <!-- Lien "Précédent" : affiché seulement si on n'est pas sur la page 1 -->
            <?php if ($page_actuelle > 1) { ?>
                <a href="?page=<?= $page_actuelle - 1 ?>">&laquo; Précédent</a>
            <?php } ?>

            <!-- Numéros de page -->
            <?php
            for ($p = 1; $p <= $nb_pages; $p++) {
                if ($p === $page_actuelle) {
                    // Page active : pas de lien, juste le numéro en surbrillance
                    echo '<span class="page-active">' . $p . '</span>';
                } else {
                    // Autres pages : lien cliquable
                    echo '<a href="?page=' . $p . '">' . $p . '</a>';
                }
            }
            ?>

            <!-- Lien "Suivant" : affiché seulement si on n'est pas sur la dernière page -->
            <?php if ($page_actuelle < $nb_pages) { ?>
                <a href="?page=<?= $page_actuelle + 1 ?>">Suivant &raquo;</a>
            <?php } ?>

        </div>
        <?php } ?>

    </div><!-- fin .container -->
</body>

</html>
