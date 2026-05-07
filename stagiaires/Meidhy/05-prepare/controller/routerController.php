<?php

// chargement des dépendances, ici la gestion de message
require PROJECT_PATH."/model/MessageModel.php";

// connexion à notre base de données 
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// récupération de tous les messages (FAKE)
$messages = selectAllMessage();


// bonne pratique, fermeture de connexion  
$connectDB = null; 

// appel de la vue 
include PROJECT_PATH."/view/homepage.html.php"; 
