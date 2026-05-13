<?php
# stagiaires/Laetitia/05-prepare/controller/routerController.php

// Chargement des dépendances, ici la gesion des messages
require PROJECT_PATH."/model/MessageModel.php";

//Connexion à notre base de données
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // Arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// On a envoyé le formulaire
if(isset($_POST['email_message'], $_POST['texte_message'])){
    // Envoi de nos variables nécessaires à l'insertion
    $insert = insertMessage($connectDB, $_POST['email_message'], $_POST['texte_message']);
}

// Récupération de tous les messages
$messages = selectAllMessage($connectDB);

// Bonne pratique, fermeture de connexion
$connectDB = null;

// Appel de la vue
include PROJECT_PATH."/view/homepage.html.php";