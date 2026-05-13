<?php

const DB_CONNECT_TYPE = "mysql";
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3307;
const DB_CONNECT_NAME = "livre_or1";
const DB_CONNECT_CHARSET = "utf8mb4";
const DB_CONNECT_USER ="root";
const DB_CONNECT_PWD = "";

const MARIA_DSN = DB_CONNECT_TYPE.":host".DB_CONNECT_HOST.";dbname=".
DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET.";";