<?php
// variable de développement, à dupliquer sous le nom de config.php

const DB_CONNECT_TYPE    = "mysql";
const DB_CONNECT_HOST    = "localhost";
const DB_CONNECT_PORT    = 3307; // WAMP -> MariaDB
const DB_CONNECT_NAME    = "exe_06";
const DB_CONNECT_CHARSET = "utf8mb4";
const DB_CONNECT_USER    = "root";
const DB_CONNECT_PWD     = "";

const MARIA_DSN = DB_CONNECT_TYPE . ":host=" . DB_CONNECT_HOST
                . ";dbname=" . DB_CONNECT_NAME
                . ";port="   . DB_CONNECT_PORT
                . ";charset=". DB_CONNECT_CHARSET . ";";

// Chemin vers la racine du projet (dossier contenant public/, controller/, model/, view/)
const ROOT_PROJECT = __DIR__;

// Pour la pagination
const NB_BY_PAGE = 5;
