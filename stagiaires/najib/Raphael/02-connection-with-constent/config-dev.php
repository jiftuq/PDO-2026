<?php
# config-prod.php
# fichier de configuration de PDO en mode dev
# ce fichier peut être envoyé sur github
# car il ne contient pas de données sensibles

const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost"; // hôte local WAMP
const DB_CONNECT_PORT = 3307; // port vers MariaDB
const DB_CONNECT_NAME = "listepays"; // nom de la DB
const DB_CONNECT_CHARSET = "utf8mb4"; // encodage de note connexion
const DB_CONNECT_USER = "root"; // login par défaut
const DB_CONNECT_PWD = ""; // pas de mot de passe par défaut