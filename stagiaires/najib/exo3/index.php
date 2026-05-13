<?php
# Contrôleur Frontal | Front Controller

# On charge les dépendances, on va prendre celui
# de développement (qui va sur github car local)
require_once 'config-dev.php';

// tentative de connection
try {
    $db = new PDO(
        dsn: MARIA_DNS,
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
    );
    // bonne pratique
    // que PDOException(= ) gestionnaire d'erreur
} catch (Exception $e) {
    die("Numero d'erreur {$e->getCode()} <br> Message d'erreur {$e->getMessage()} ");
};

// si on a envoyé le formulaire 
if (isset($_POST['email'], $_POST['title'], $_POST['text'])) {
    // en pricipe, des que on a des entées utilisateur 
    // on ferra des requetes préparées
    // mais pas maintenant, on va utilisé des requetes
    // on protége nos variable
    $mail = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
    $text = htmlspecialchars(trim(strip_tags($_POST['text'])));

    // si tous les champs sont valide
    if ($mail === false || empty($title) || empty($text)) {
        $erreur = "Bien essayé, <a href='javascript:history.go(-1)'> recommence </a>";
    }else {
        $db->exec("INSERT INTO livre (`email`,`title`,`texte`) VALUE ('$mail ',' $title ',' $text');");

        // notre resultat vaut 1 
        if ($db) {
            $reussite = "<h3> Merci  pour votre message </h3>
            <script> // redirection js
        setTimeout(() => {
            window.location.href='./';
        }
            , '3000'); </script>";
        };
    }
}

// on va récupérer tous les messages 
$sql = "SELECT * FROM `livre` ORDER BY `datetime` ASC";
$request = $db->query($sql);
// compter le nombre de résultat
$nbArticle = $request->rowCount();

// transformation du ou des résultat en tableau indexé contenant des tableau associatifs
$articles = $request->fetchAll(PDO::FETCH_ASSOC);

// bonne pratique
$request->closeCursor();
// déconnection de la db
$db = null;
// s'il n'y a pas d'acticle -> nbarticle = 0
if ($nbArticle === 0) {
    $message = "pas encore de commentaires";
} elseif ($nbArticle === 1) {
    $message = "il y a {$nbArticle} commentaire";
} else {
    $message = "il y a {$nbArticle} commentaires";
};

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <?php if (isset($reussite)) {
        echo $reussite;
    } ?>
    <div class="container">
        <h1>📖 Livre d'or</h1>
        <?php if (isset($erreur)) {
            echo ($erreur);
        }; ?>
        <div class="form-box">
            <form method="POST" action="">

                <div class="form-group">
                    <label for="email">Votre Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="title">Votre title :</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="text">Votre Commentaire :</label>
                    <textarea id="text" name="text" required></textarea>
                </div>

                <button type="submit" class="btn">Laisser un Commentaire</button>
            </form>
        </div>

        <?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
            <div class="comments">Nombre de commentaires : <?php echo $nbArticle; ?></div>
        <?php } ?>
    </div>
    <div class="comments-list">
        <?php foreach($articles as $article): ?>
            <div class="commentaires-utilisateur">
                <h3><?= htmlspecialchars($article["title"], ENT_QUOTES, 'UTF-8') ?></h3>
                <p><?= htmlspecialchars($article["datetime"], ENT_QUOTES, 'UTF-8') ?></p>
                <p><?= htmlspecialchars($article["texte"], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>