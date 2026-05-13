<?php

require_once 'config-dev.php';

try{
    $db = new PDO(
        DB_CONNECT_TYPE.":",
        DB_CONNECT_USER."e",
        DB_CONNECT_PWD
    );
}catch(PDOException $e){
    echo "Code erreur : ".$e->getCode();

    echo "Message erreur : ".$e->getMessage(); 
}