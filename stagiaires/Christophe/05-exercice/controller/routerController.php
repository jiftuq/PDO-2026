<?php
// 05-exercice/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire
# Appel de dépendances
require ROOT_PROJECT."/model/CommentaireModel.php";

# Création de notre connexion PDO (avec try catch)
# → déjà faite dans public/index.php, $db disponible ici

# suivant les actions utilisateur, appelez les vues.

// simple routing via ?page=
$page = $_GET['page'] ?? 'home';

// si l'utilisateur a envoyé le formulaire (depuis la page add)
if($page === 'add' && isset($_POST['email'], $_POST['title'], $_POST['fullName'], $_POST['text_comment'])){
    $insert = addCommentaire($db, $_POST);
    // après envoi réussi, rediriger vers la liste pour éviter le repost
    if($insert === true){
        header('Location: '.$_SERVER['PHP_SELF'].'?page=comments');
        exit;
    }
}

// pour la page commentaires : on prend les messages + pagination
if($page === 'comments'){
    // bonus pagination
    $numPage = isset($_GET['p']) ? (int) $_GET['p'] : 1;
    if($numPage < 1) $numPage = 1;

    $nb = countCommentaires($db);

    $perPage = 5;
    $nbPages = (int) ceil($nb / $perPage);
    if($nbPages < 1) $nbPages = 1;
    if($numPage > $nbPages) $numPage = $nbPages;

    $offset = ($numPage - 1) * $perPage;

    $commentaires = readCommentaires($db, $perPage, $offset);
}

// Appel de la vue en fonction de la page
if($page === 'comments'){
    include ROOT_PROJECT."/view/comments.html.php";
} elseif($page === 'add'){
    include ROOT_PROJECT."/view/add_comment.html.php";
} else {
    include ROOT_PROJECT."/view/homepage.html.php";
}
