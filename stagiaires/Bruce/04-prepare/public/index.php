<?php
// ============================================================
// CONTRÔLEUR FRONTAL (Front Controller)
// C'est le seul fichier accessible depuis le navigateur
// Il charge tout le reste
// ============================================================

// Chargement de la configuration (connexion base de données)
require_once '../config-dev.php';

// Tentative de connexion à la base de données
try {
    $db = new PDO(
        dsn:      MARIA_DSN,
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
        options: [
            // Affiche les erreurs SQL clairement (indispensable en développement)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Appel du router (traitement des actions + affichage)
require_once ROOT_PROJECT . "/controller/routerController.php";

// Fermeture de la connexion
$db = null;
