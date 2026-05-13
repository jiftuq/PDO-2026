<?php
# stagiaires/Laetitia/02-connection-with-constent/index.php

// Chargement des dépendances.
require_once 'config-dev.php';

// On veut se connecter (essai).
try {
    // Tentative de connexion.
    $db = new PDO(
                // mysql:
    dsn:        DB_CONNECT_TYPE.":".
                // host=localhost
                "host=".DB_CONNECT_HOST .
                // ;dbname=listepays
                ";dbname=".DB_CONNECT_NAME .
                // ;port=1107
                ";port=".DB_CONNECT_PORT .
                // ;charset=utf8mb4;
                ";charset=".DB_CONNECT_CHARSET . ";"
    ,
    username:   DB_CONNECT_USER,
    password:   "",
    );
// En cas d'etteur (équivalent $e = new PDOException).
}catch(PDOException $e) {
    // On récupère l'erreur et on l'affiche
    echo "Erreur numéro : ".$e->getCode(); // Le code
    echo "<br>Message de l'Erreur : ".$e->getMessage(); // Le message
}

// Création de la requête SELECT sans variables utilisateurs
// du plus peuplé au moins peuplé.
$sql = "
    SELECT c.`nom`, c.`population`, c.`continent`, c.`capitale` 
        FROM `countries` c
        ORDER BY `population` DESC
        ";

// Véritable requête.
$request = $db->query($sql);

// On récupère les données dans un format lisible par PHP.
$resultats = $request->fetchAll(PDO::FETCH_ASSOC);

//Bonne pratique
// Pas utile pour SQL ou MariaDB
$request->closeCursor();

// On compte le nombre de ligne résultat SQL
$count = $request->rowCount();

//Bonne pratique
// Pas utile pour SQL ou MariaDB
// sauf si requête prermanente
$db = null;


/* Compte sur un tableau
$count = count($resultats);
*/

/*
// Transformation en json
$json = json_encode($resultats, JSON_PRETTY_PRINT);
// On va écrire un fichier .json
// pour ne plus devoir faire la requête
// pour "monsieur tout le monde"
// Création du fichier si il n'existe pas, sinon ouverture.
$file = fopen("allCountries.json","wr");
    fputs($file,$json);
fclose($file);

var_dump($db, $request, $resultats);
*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les pays du monde</title>    
</head>
<body>
    <h1>Les pays du monde (<?= $count?>)</h1>
    <table>
        <thead>
            <tr>
                <td>Pays</td>
                <td>Population</td>
                <td>Capitale</td>
            </tr>
        </thead>
        <tbody>
        <?php
        // tant qu'on a des pays
        foreach($resultats as $item):
        ?>
        <tr>
            <td><span title="<?= $item['continent'] ?>"><?= $item['nom'] ?></span></td>
            <td><?= $item['population'] ?></td>
            <td><?= $item['capitale'] ?></td>
        </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</body>
</html>