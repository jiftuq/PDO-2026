<?php
# stagiaires/Robin/02-connexion/index.php
 
// Chargement des dépendances
require_once 'config-dev.php';
 
// On veut se connecter (essai)
try{
 
    // Tentative de connexion
    $db = new PDO(
                    // mysql
        dsn:        DB_CONNECT_TYPE.":" .
                    // host=localhost
                    "host=".DB_CONNECT_HOST .
                    // ;dbname=listepays
                    ";dbname=".DB_CONNECT_NAME .
                    // ;port=3307
                    ";port=".DB_CONNECT_PORT .
                    // ;charset=utf8mb4;
                    ";charset=".DB_CONNECT_CHARSET
        ,
        username:   DB_CONNECT_USER,
        password:   DB_CONNECT_PWD,
        );
 
// En cas d'erreur (équivalent $e = new PDOException)
}catch(PDOException $e){
 
    // On récupère l'erreur  et on l'affiche
    echo "Erreur numéro : ".$e->getCode(); // le code
    echo "<br>Message de l'Erreur : ".$e->getMessage(); // le message
 
}

// Création de la requête SELECT sans variable utilisateurs
// du plus peuplé au moins peuplé
$sql = "
    SELECT 
        c.`nom`, c.`population`, c.`continent`, c.`capitale`
    FROM `countries` c 
        ORDER BY c.`population` DESC;
 ";

// Véritable requête
$request = $db->query($sql);

// On compte le nombre de ligne de résultats SQL
$count = $request->rowCount();

// On récupère les données dans un format lisible par PHP
$resultats = $request->fetchAll(PDO::FETCH_ASSOC);

// Compte le nombre de ligne du tableau de résultat
// $count = count($resultats);

// Bonne pratique
// Pas utile pour Maria ou MySQL
$request->closeCursor();

// Bonne pratique
// Pas utile pour Maria ou MySQL
// Sauf si requête pas 
$db = null;

// Transformation Json
$json = json_encode($resultats , JSON_PRETTY_PRINT);

// On va écrire un fichier .json
// Pour ne plus devoir faire la requête 
// Pour monsieur tout le monde
// Création du fichier si il n'existe pas, sinon ouverture
$file = fopen("allcountries.json","wr");
    fputs($file, $json);
fclose($file);

// var_dump($db, $request, $resultats); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les pays du monde</title>
</head>
<body>
    <h1>Les pays du monde (<?= $count ?>)</h1>
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