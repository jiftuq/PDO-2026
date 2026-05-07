<?php
# stagiaires/Laetitia/02-connection-with-constent/config-dev.php
# config-dev.php
# fichier de configuration de PDO en mode dev.
# Ce fichier peut être sur github car il ne contient pas de données sensibles
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost"; // Hôte locam Wamp
const DB_CONNECT_PORT = 3307; // Port MariaDB
const DB_CONNECT_NAME = "livreor_web1"; // Nom de la DB
const DB_CONNECT_CHARSET = "utf8mb4"; // Encodage de notre connexion
const DB_CONNECT_USER = "root"; // Login par défaut
const DB_CONNECT_PWD = ""; // Pas de mot de passe par défaut

// Pour se connecter via DSN
const DB_DSN = DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET;

// Chemin vers la racine du projet
const PROJECT_PATH = __DIR__;