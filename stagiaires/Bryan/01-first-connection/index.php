<?php
# connection a la base de MariaDB
# 'listepays' sur 3307
# mysql: -> on se connecte a mysql ou MariaDB
# host=localhost; -> ip ou url du serveur
# dbname=listepays; -> nom de la base de donnée
# port=3307; -> port (ici vers MariaDB)
# charset=utf8mb4 -> encodage de la connexion
$connectionDB = new PDO("mysql:host=localhost;
dbname=listepays;port=3307;charset=utf8mb4",
    "root",
    ""

);
# On va récuperer tout les pays de la DB "listepays"
$request = $connectionDB->query(
    "SELECT * FROM `countries`;"
);
var_dump($connectionDB, $request);

// Mauvaise pratique recommandée par toutes les IA
// (ingérable en OO), mais vide la mémoire donc
// plus rapide
while ($item = $request->fetch(PDO::FETCH_ASSOC)) {
    echo $item['nom'] . " | ";
}
// bonne pratique (mais tard si on utilise l'affichage avant la déconnexion)

$request->closeCursor();
$connectionDB = null;
?>