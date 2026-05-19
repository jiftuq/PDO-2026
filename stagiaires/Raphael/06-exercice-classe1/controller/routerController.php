<?php
// stagiaires/Michael/06-exercice-classe1/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire
require PROJECT_PATH."/model/CommentaireModel.php";




# Création de notre connexion PDO (avec try catch)
// Connection à notre base de donnée
try{
    $connectDB = new PDO(MARIA_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}


// lien formulaire => fonctions

// On a evnoyé le formulaire
if(isset($_POST['email'],$_POST['full_name'],$_POST['title'],$_POST['text_comment'])){
    // envoi de nos variables nécessaires à l'insertion
    $insert = addCommentaire($connectDB,$_POST['email'],$_POST['full_name'],$_POST['title'],$_POST['text_comment']);

if ($insert) {
        header("Location: ./?page=comments&merci=1");
        exit;
    }
}

$nbCommentaires = countAllCommentaires($connectDB);



# suivant les actions utilisateur, appelez les vues.

if(!isset($_GET['page'])){
    //  on charge la page d'accueil
    include PROJECT_PATH."/view/homepage.html.php";
// sinonsi la variable get 'page' a une valeur 
// acceptée dans la constante de type array PUBLIC_PAGES
}elseif(in_array($_GET['page'],PUBLIC_PAGES)){

    if ($_GET['page'] === 'comments') {
            $commentaires = readAllCommentaires($connectDB);
        }
  // si la variable get correspond à une valeur
  // acceptée dans le tableau
  include PROJECT_PATH."/view/".$_GET['page'].".html".".php";

// sinon, la variable get page existe
}else{

    // Appel de l'erreur 404
    include PROJECT_PATH."/view/404.php";

}