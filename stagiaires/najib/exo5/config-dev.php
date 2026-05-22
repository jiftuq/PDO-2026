<?php
# A MODIFIER POUR L'EXERCICE

// variable de développement, à dupliquer
// son le nom de config.php
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3307;// WAMP -> MariaDB
const DB_CONNECT_NAME = "exe_05";
const DB_CONNECT_CHARSET = "utf8mb4";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";
// pour raccourcir la connexion
const MARIA_DSN = DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET.";";

// chemin vers la racine du projet
const ROOT_PROJECT = __DIR__;

// nombre de réponses par page
const COMMENTAIRE_PAR_PAGE = 5;