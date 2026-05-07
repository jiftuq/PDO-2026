<?php
# Contrôleur Frontal | Front Controller

# On charge les dépendances, on va prendre celui
# de développement (qui va sur github car local)
require_once '../config-dev.php';

// tentative de connection
try {
    $db = new PDO(
        dsn: MARIA_DSN,
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
    );
    // bonne pratique
    // que PDOException(= ) gestionnaire d'erreur
} catch (Exception $e) {
    die("Numero d'erreur {$e->getCode()} <br> Message d'erreur {$e->getMessage()} ");
};

// Appel de notre router
require_once ROOT_PROJECT."/controller/routerController.php";

// fermeture de connexion
$db = null;


