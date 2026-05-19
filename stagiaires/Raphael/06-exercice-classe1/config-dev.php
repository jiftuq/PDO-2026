<?php
# A MODIFIER POUR L'EXERCICE

// variable de développement, à dupliquer
// son le nom de config.php
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3307;// WAMP -> MariaDB
const DB_CONNECT_NAME = "exe_06";
const DB_CONNECT_CHARSET = "utf8mb4";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";
// pour raccourcir la connexion
const MARIA_DSN = DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST. ";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET.";";

// chemin vers la racine du projet
const PROJECT_PATH = __DIR__;

// pour la pagination
const NB_BY_PAGGE = 5;


const PUBLIC_PAGES = [
    // inutile car identique que sans
    // variables GET 'index',
    'comments',
    'addcomments',
];