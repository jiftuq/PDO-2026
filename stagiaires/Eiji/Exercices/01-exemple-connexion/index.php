<?php
// contrôleur frontal | Front controller

// on charge les dépendances, on va prendre celui de développement (qui va sur github car local)
require_once 'config-dev.php';

// on essaye de se connecter
try{
    $db = new PDO(
        dsn: DB_CONNECT_TYPE.":",
        username: DB_CONNECT_USER."e",
        password: DB_CONNECT_PWD,
    );

// si on a une erreur, on instancie automatiquement 
// avec -$e avec PDOException 
// ex => $e = new PDOException

}catch(PDOException $e){
    // pour affichage du code erreur
    echo "Code Erreur : ".$e->getCode();
    // on affiche le message
    echo "<br>Message d'Erreur : ".$e->getMessage();

}