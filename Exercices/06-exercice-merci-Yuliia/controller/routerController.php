<?php
// stagiaires/Yuliia/06-exercice-classe1/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire

# Création de notre connexion PDO (avec try catch)

# suivant les actions utilisateur, appelez les vues.

// chargement des sépendances, ici la gestion de message
require ROOT_PROJECT."/model/CommentaireModel.php";

// connection à notre base de donnée 
try {
    $connectDB = new PDO(
        dsn: MARIA_DSN, 
        username: DB_CONNECT_USER, 
        password: DB_CONNECT_PWD, 
        // options, on active les erreurs pour ne pas avoir de pages blanches en cas de désaxtivation (optionnel depuis PHP 8.0)
        options:[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
    );

    // option, on peut les ajouter après la connexion (donc en dehors de options:), sauf pour la connexion permanente, ici il s'agit du format de récupération php tableaux associatifs
    $connectDB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (Exception $e) {
    // arrêt et affichage de l'erreur (ev dev)
    die($e->getMessage());
}


// on a envoyé le formulaire 
if(isset($_POST['email'],$_POST['text_comment'],$_POST['title'],$_POST['full_name'])){
    // envoi de nos var nécessaires à l'insertion 
    $addCommentaire=addCommentaire($connectDB,$_POST['email'],$_POST['text_comment'],$_POST['title'],$_POST['full_name']);
}

// recuperation de tous les messages PLUS UTILE DEPUIS PAGINATION
// $comments=readAllCommentaires($connectDB);

// on compte les commentaires totaux
$countComments = countAllCommentaires($connectDB);



if (!isset($_GET['p'])){
    // nous sommes dans l'accueil
    include ROOT_PROJECT."/view/homepage.html.php";

}elseif(in_array($_GET['p'],ARRAY_VALID_PAGES)){

    // si il existe la variable de pagination
    if(isset($_GET[PAGINATION_NAME_GET])){
        $page = (int) $_GET[PAGINATION_NAME_GET];
    }else{
        $page = 1;
    }

    // récupération de $comments en utilisant la fonction de pagination
    $comments = readPaginationCommentaires($connectDB,$page,PAGINATION_NB_PAGE);

    
    // création de la pagination en html avec les variables get nécessaires
    $pagination = pagination($countComments,'?p=comments',PAGINATION_NAME_GET,$page,PAGINATION_NB_PAGE);   

     include ROOT_PROJECT."/view/".$_GET['p'].".php";
}else {
     
    //  include ROOT_PROJECT."/view/error404.php";
}

// bonne pratique, fermeture de connexion
$connectDB=null;