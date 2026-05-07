<?php
# config-prod.php
# fichier de configuration de PDO en mode production
# données sensibles !
# constantes de connexion à la base de données
# à modifier vers votre environnement de production
# et votre base de données online
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3307;
const DB_CONNECT_NAME = "listepays";
const DB_CONNECT_CHARSET = "utf8mb4";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";