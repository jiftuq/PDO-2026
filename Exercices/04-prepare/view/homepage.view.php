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
    if(isset($insert)&&$insert===true):
        ?>
        <button class='btn-valid'>Merci pour votre commentaire</button>
        <?php
    // on a posté un message et ça n'a fonctionné       
    elseif(isset($insert)&&$insert===false):
        ?>
        <button class='btn-unvalid'>Votre commentaire n'est pas valide</button>
        <?php
    endif;
        ?>
        <div class="form-box">
            <form method="POST" action="">

                <div class="form-group">
                    <label for="email">Votre Email :</label>
                    <input type="text" id="email" name="email" >
                </div>
                <div class="form-group">
                    <label for="title">Votre title :</label>
                    <input type="text" id="title" name="title" >
                </div>

                <div class="form-group">
                    <label for="text">Votre Commentaire :</label>
                    <textarea id="text" name="text" ></textarea>
                </div>

                <button type="submit" class="btn">Laisser un Commentaire</button>
            </form>
        </div>
        <?php  var_dump($_POST); ?>

            <div class="comments">
                <?php
                $nb = count($livres);
                if ($nb === 0):
                ?>
                    <h2>Pas encore de commentaire</h2>
                <?php elseif ($nb === 1): ?>
                    <h2>Il y a 1 commentaire</h2>
                <?php else: ?>
                    <h2>Il y a <?= $nb ?> commentaires</h2>
                <?php endif; ?>
            </div>
            <div class="comments-list">
                <?php foreach ($livres as $livre): ?>
                <div class="commentaires-utilisateur">
                    <h2><?= htmlspecialchars($livre['title']) ?></h2>
                    <p><?= htmlspecialchars($livre['email']) ?></p>
                    <p><?= htmlspecialchars($livre['text']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
</body>

</html>