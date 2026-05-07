<?php 
// chargement des sépendances, ici la gestion de message
require PROJECT_PATH."/model/MessageModel.php";

// connection à notre base de donnée 
try {
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
} catch (Exception $e) {
    // arrêt et affichage de l'erreur (ev dev)
    die($e->getMessage());
}
// recuperation de tous les messages (fake)
$messages=selectAllMessages().

// bonne pratique, fermeture de connexion
$connectDB=null;

// Appel de la vue
include PROJECT_PATH."/view/homepage.html.php";