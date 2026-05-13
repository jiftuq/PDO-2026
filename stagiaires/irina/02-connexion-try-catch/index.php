<?php
# Contrôleur Frontal | Front Controller

# On charge les dépendances, on va prendre celui
# de développement (qui va sur github car local)
require_once 'config-dev.php';

// on essaye de se connecter
try{
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST. //mysql:host=localhost
        ";dbname=".DB_CONNECT_NAME. //;dbname=listepays
        ";port=".DB_CONNECT_PORT. //;port=3307
        ";charset=".DB_CONNECT_CHARSET.";" //;charset=utf8mb4;
         ,
        DB_CONNECT_USER, // root
        DB_CONNECT_PWD,//''
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
  //on effectue réelement la requete de typeselect qui va dans un objet de type PDOStatement
 $request = $db -> query("SELECT * FROM 'countries' ORDER BY 'countries'.'population' DESC;"); 

//on recupère les données immediatement
$results = $request ->fetchAll(PDO::FETCH_ASSOC);



//bonne pratique
//fermeture du curseur
$request -> closeCursor();

//bonne pratique
//fermiture de la connexion
$db = null;

/*
//création d'un jison,
echo json_encode($results);  
$json = json_encode($results);
$create = fopen('jsonta-'.date('Y-m-d-H-i-s').'-'.uniqid(true)json", "wr");
fwrite($create, $json);
fclose($create);
*/


/*
// bonne pratique
$db = null; // on ferme la connexion
// */
//var_dump($db, $request, $results);


 
?>
<!DOCTYPE html>
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
                    <th>Pays</th>
                    <th>Population</th>
                    <th>Capitale</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // tant qu'on a des pays 
                foreach($results as $item):
                     ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
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