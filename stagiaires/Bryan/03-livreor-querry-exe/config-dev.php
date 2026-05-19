<?php
// MySQL et MariaDB
const DB_CONNECT_TYPE = "mysql"; 

// hôte local WAMP
const DB_CONNECT_HOST = "localhost"; 

// port vers MariaDB
const DB_CONNECT_PORT = 3307;

// nom de la DB
const DB_CONNECT_NAME = "livreor_web1";

// encodage de notre connexion
const DB_CONNECT_CHARSET = "utf8mb4";

// login par défaut
const DB_CONNECT_USER = "root";

// pas de mot de passe par défaut
const DB_CONNECT_PWD = "";

// DSN (Data Source Name) : chaîne de connexion
const DB_DSN = DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET;