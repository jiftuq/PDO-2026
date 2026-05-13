<?php
// stagiaires/Yuliia/06-exercice-classe1/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire

# Création de notre connexion PDO (avec try catch)

# suivant les actions utilisateur, appelez les vues.

if (!isset($_GET['p'])){
    // nous sommes dans l'accueil
    include ROOT_PROJECT."/view/homepage.html.php";

}elseif(in_array($_GET['p'],ARRAY_VALID_PAGES)){

     include ROOT_PROJECT."/view/".$_GET['p'].".php";
}else {
     
    //  include ROOT_PROJECT."/view/error404.php";
}