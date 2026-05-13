<?php       

// notre premiere connexion

$connexionPDO = new PDO(
    // dsn (data source name) -> paramettre de connexion à la db listepays sur le port 3307
    // de nore host locahost en chartset ut
    dsn: "mysql:host=localhost;dbname=listepays;port=3307;charset=utf8mb4",
    username: "root",
    password: "",
);

$request = $connexionPDO->query("
    SELECT * FROM countries
");


var_dump($connexionPDO, $request);


while($item = $request->fetch(PDO::FETCH_ASSOC)){
    echo $item['nom']." | ";
}

# bonne pratique, fermer la requette

$request->closeCursor();

#fermer la connexion (inutile pour MySQL et MariaDB)

$connexionPDO = null;