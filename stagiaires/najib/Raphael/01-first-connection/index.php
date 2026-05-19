<?php
# Connexion à la base MariaDB
# 'listepays' sur 3307
# mysql: -> on se connecte à MySQL ou MariaDB
# host=localhost -> ip ou url du serveur
$connectionDB = new PDO('mysql:host=localhost;dbname=listepays;port=3307;charset=utf8mb4',
                        'root', 
                        '',
                        );
// $db = $connectionDB;
// var_dump($connectionDB,$db);
// $sql = "SELECT * FROM `countries`";
// $query = $connectionDB->query($sql);
// $results = $query->fetchAll(PDO::FETCH_ASSOC);
// var_dump($results);
$request = $connectionDB->query(
    "SELECT * FROM `countries`;"
);

var_dump($connectionDB,$request);

// Mauvaise pratique recommandée par toutes les IA
// (ingérable en OO) mais vide la mémoire donc plus rapide
// affiche les résultats ligne par ligne
while($item = $request->fetch(PDO::FETCH_ASSOC)){
    echo $item['nom']." | ";
}

// bonne pratique (mais plus tard si on utilise l'affichage avant la déconnexion)
// inutile pour MariaDB et MySQL, utile pour d'autres
// systèmes SQL
$request->closeCursor();

// Fermeture de de la connexion
// inutile pour MariaDB et MySQL, utile pour d'autres
$connectionDB = null;