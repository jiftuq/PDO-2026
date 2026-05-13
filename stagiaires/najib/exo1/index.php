<?php
# Contrôleur Frontal | Front Controller

# On charge les dépendances, on va prendre celui
# de développement (qui va sur github car local)
require_once 'config-dev.php';

// on essaye de se connecter
try{
    $db = new PDO(
        // mysql:host=localhost
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST. 
        // ;dbname=listepays
        ";dbname=".DB_CONNECT_NAME.
        // ;port=3307
        ";port=".DB_CONNECT_PORT.
        // ;charset=utf8mb4;
        ";charset=".DB_CONNECT_CHARSET.";"
        ,
        // root
        DB_CONNECT_USER,
        // ''
        DB_CONNECT_PWD,
    );

// si on a une erreur
// on instancie automatiquement
// $e avec PDOException 
// $e = new PDOException()    
}catch(PDOException $e){
    // on affiche le code erreur
    echo "Code Erreur : ".$e->getCode();
    // on affiche le message
    echo "<br>Message d'Erreur : ".$e->getMessage();

}

// on effectue réellement la requête
// de type select qui va dans un objet
// de type PDOStatment
$request = $db->query("
SELECT 
    c.`nom`, c.`population`, c.`continent`, c.`capitale`
 FROM `countries` c 
    ORDER BY c.`population` DESC;
 ");

 // on récupère nos données immédiatement
 $results = $request->fetchAll(PDO::FETCH_ASSOC);

 // bonne pratique
 // fermeture du curseur
 $request->closeCursor();

 // bonne pratique
 // fermeture de la connexion
 $db = null;

 /* création d'un json
 $json = json_encode($results);
 $create = fopen('jsonta-'.date('YmdHis').'-'.uniqid(true).".json","wr");
 fwrite($create,  $json); 
 fclose($create);
 */

//var_dump($db,$request,$results);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les pays du monde</title>
</head>
<body>
    <h1>Les pays du monde</h1>
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