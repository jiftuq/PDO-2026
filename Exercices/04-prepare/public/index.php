<?php
# Contrôleur Frontal | Front Controller

# On charge les dépendances, on va prendre celui
# de développement (qui va sur github car local)
require_once '../config-dev.php';

// tentative de connection
try {
    $db = new PDO(
        dsn: MARIA_DSN,
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
    );
    // bonne pratique
    // que PDOException(= ) gestionnaire d'erreur
} catch (Exception $e) {
    die("Numero d'erreur {$e->getCode()} <br> Message d'erreur {$e->getMessage()} ");
};

include ROOT_PROJECT."/view/homepage.view.php";

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
