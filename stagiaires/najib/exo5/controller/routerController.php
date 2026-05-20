<?php
// 05-exercice/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire

# Création de notre connexion PDO (avec try catch)

# suivant les actions utilisateur, appelez les vues.
# Appel de dépendances
require ROOT_PROJECT."/model/CommentaireModel.php";

// simple routing via ?page=
$page = $_GET['page'] ?? 'home';

// si l'utilisateur a envoyé le formulaire (depuis la page add)
if(!empty($_POST)){
    $insert = addCommentaire($db, $_POST);
    // après envoi, rediriger vers la liste pour éviter le repost
    header('Location: '.$_SERVER['PHP_SELF'].'?page=comments');
    exit;
}

// on prend les messages (utilisé par la page commentaires)
$commentaires = readCommentaires($db);

// Appel de la vue en fonction de la page
if($page === 'comments'){
    include ROOT_PROJECT."/view/comments.html.php";
} elseif($page === 'add'){
    include ROOT_PROJECT."/view/add_comment.html.php";
} else {
    include ROOT_PROJECT."/view/homepage.html.php";
}