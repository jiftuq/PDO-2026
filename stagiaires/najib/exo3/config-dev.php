<?php

// variable de développement, à dupliquer
// son le nom de config.php
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3307;// WAMP -> MariaDB
const DB_CONNECT_NAME = "livre_or1";
const DB_CONNECT_CHARSET = "utf8mb4";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";

// pour racourcir la conexion
const MARIA_DNS = DB_CONNECT_TYPE.":".
        "host=".DB_CONNECT_HOST.
        ";dbname=".DB_CONNECT_NAME.
        ";port=".DB_CONNECT_PORT.
        ";charset=".DB_CONNECT_CHARSET.";";