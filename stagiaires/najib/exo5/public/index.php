<?php
// 05-exercice/public/index.php

# Importation de ../config-dev.php 
require_once "../config-dev.php";

// tentaive de connection
try {
     $db = new PDO(
       dsn: MARIA_DSN,
       username: DB_CONNECT_USER,
       password: DB_CONNECT_PWD,
    );

} catch (Exception $e) {
        die("Numero d'erreur {$e->getCode()} <br> Message d'erreur {$e->getMessage()} ");
}


# Importation du router : ROOT_PROJECT."/controller/routerController.php"
require_once ROOT_PROJECT ."/controller/routerController.php";

// fermeture de connexion
$db = null;