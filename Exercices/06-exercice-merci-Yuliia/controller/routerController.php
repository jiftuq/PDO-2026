<?php
// stagiaires/Yuliia/06-exercice-classe1/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire

# Création de notre connexion PDO (avec try catch)

# suivant les actions utilisateur, appelez les vues.

// chargement des sépendances, ici la gestion de message
require ROOT_PROJECT."/model/CommentaireModel.php";

// connection à notre base de donnée 
try {
    $connectDB = new PDO(MARIA_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
} catch (Exception $e) {
    // arrêt et affichage de l'erreur (ev dev)
    die($e->getMessage());
}


// on a envoyé le formulaire 
if(isset($_POST['email'],$_POST['text_comment'],$_POST['title'],$_POST['full_name'])){
    // envoi de nos var nécessaires à l'insertion 
    $addCommentaire=addCommentaire($connectDB,$_POST['email'],$_POST['text_comment'],$_POST['title'],$_POST['full_name']);
}

// recuperation de tous les messages (fake)
$comments=readAllCommentaires($connectDB);

// bonne pratique, fermeture de connexion
$connectDB=null;



if (!isset($_GET['p'])){
    // nous sommes dans l'accueil
    include ROOT_PROJECT."/view/homepage.html.php";

}elseif(in_array($_GET['p'],ARRAY_VALID_PAGES)){

     include ROOT_PROJECT."/view/".$_GET['p'].".php";
}else {
     
    //  include ROOT_PROJECT."/view/error404.php";
}