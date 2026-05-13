<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    // var_dump($_POST);
    ?>
    <div class="container">
        <h1>📖 Livre d'or</h1>
        <?php
        // on a posté un message et ça a fonctionné    
        if (isset($insert) && $insert === true):
        ?>
            <button class='btn-valid'>Merci pour votre commentaire</button>
        <?php
        // on a posté un message et ça n'a fonctionné       
        elseif (isset($insert) && $insert === false):
        ?>
            <button class='btn-unvalid'>Votre commentaire n'est pas valide</button>
        <?php
        endif;
        ?>
        <div class="form-box">
            <form method="POST" action="">

                <div class="form-group">
                    <label for="email">Votre Email :</label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="title">Votre titre :</label>
                    <input type="text" id="title" name="title">
                </div>

                <div class="form-group">
                    <label for="text">Votre Commentaire :</label>
                    <textarea id="text" name="text"></textarea>
                </div>

                <button type="submit" class="btn">Laisser un Commentaire</button>
            </form>
        </div>

        <?php $commentCount = count($livres); ?>
        <div class="comments">
            <?php if ($commentCount === 0): ?>
                <p>Pas encore de commentaire.</p>
            <?php elseif ($commentCount === 1): ?>
                <p>Il y a 1 commentaire.</p>
            <?php else: ?>
                <p>Il y a <?= $commentCount ?> commentaires.</p>
            <?php endif; ?>
        </div>

        <div class="comments-list">
            <?php foreach ($livres as $article): ?>
                <div class="commentaires-utilisateur">
                    <h3><?= htmlspecialchars($article["title"], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="comment-meta">
                        <?= htmlspecialchars($article["email"], ENT_QUOTES, 'UTF-8') ?> -
                        <?= htmlspecialchars($article["datetime"], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p><?= htmlspecialchars($article["texte"], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
</body>

</html>