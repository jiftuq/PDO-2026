<?php
# stagiaires\Yuliia\02-connection-with-constants\index.php

// chargement des dépendances
require_once 'config-dev.php';
// on veut se connecter (essai )
try {

    //tentetive de connexion
    $db = new PDO(
        //mysql:
        dsn: DB_CONNECT_TYPE.":".
        //host=localhost
        "host=". DB_CONNECT_HOST .
        //;dbname=listpays
        ";dbname=".DB_CONNECT_NAME .
        //;port= 
        ";port=".DB_CONNECT_PORT .
       //chatset=utf8mb4;
       ";charset=".DB_CONNECT_CHARSET.";", //
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
    );


    // en cas d'erreur (équivqlent $e = new PDOException)
} catch (PDOException $e) {

    // on récupère l'erreur et on m'affiche
    echo "Erreur numéro : " . $e->getCode(); //le code 
    echo "<br> Message de l'Erreur : " . $e->getMessage(); //le message
}

$sql="
SELECT  c.`nom`, c.`population`, c.`continent`, c.`capitale`
FROM `countries` c
ORDER BY  c.`population` DESC;
";
$request=$db->query($sql);
$count=$request->rowCount();
$results=$request->fetchAll(PDO::FETCH_ASSOC);

// $json=json_encode($results,JSON_PRETTY_PRINT);
// echo "<pre>$json</pre>";

//création du fichier si il n'existe pas, sinon ouverture
// $file = fopen("allCountries.json","wr");
// fputs($file,$json);

$request->closeCursor();
$db=null;
// fclose($file);
//$count=count($results);

var_dump($db,$request,$results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les pays du monde</title>
</head>
<body>
    <h1>Les pays du monde : <?=  ($count) ?> </h1>
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
        foreach($results as $item):
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

 
