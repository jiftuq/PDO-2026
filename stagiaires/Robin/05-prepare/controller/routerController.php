<?php
# Stagiaires/robin/05-prepare/controller/routerController.php

// Chargement des dépendances 
require ROOT_PROJECT."/model/MessageModel.php";

// Connexion à notre base de donnée
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// Récupération de tous les messages (fake)
$messages = selectAllMessage();

// Bonne pratique, fermeture de connexion
$connectDB = null;

// Appel de la vue
include ROOT_PROJECT."/view/homepage.html.php";