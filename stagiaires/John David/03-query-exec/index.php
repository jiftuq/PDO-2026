<?php
require_once 'config-dev.php';

try{

    $bdd = new PDO(
        dsn: MARIA_DSN,
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
    );

}catch(Exception $e){
    die("Numero d'erreur {$e->getCode()} <br> Message 
    d'erreur : {$e->getMessage()}");
}
if(reset($_POST['email'],$_POST['titre'],$_POST['texte'])){

}

$sql = "SELECT * FROM 'livres' ORDER BY 'datetime' ASC";
$request = $bdd->query($sql);

$nbArticle = $request->rowCount();

if($nbArticle===0){
    $message = "Pas encore de commentaire";
}elseif($nbArticle===1){
    $message = "Nous avons $nbArticle message";
}else{
    $message = "Nous avons $nbArticle messages";
}

$request->closeCursor();

$bdd = null
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or </title>
    <style>
        body{
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%, #0c3c8f 100%);
            
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: #eee6e6;
            padding: 50px;
            margin: 60px auto;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 25px;
            color: #000000;
        }

        /* form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        } */
        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: black solid 0,5;
            border-radius: 5px;
        }

        form button {
            background-color: #3965dd;
            width: 100%;
            color: hsl(0, 0%, 100%);
            border: solid black 0,5;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            min-height: 14px;
        }

        h1{
            color: rgb(141, 210, 36);
            font-weight: bold;
            font-size: 3em;
        }
    </style>
</head>
<body>
    <form>
    <h2>livre d'or</h2>  
    <div class="field">
      <label>Email</label>
      <input type="text" id="email" name="email">
      <span class="error"></span>
    </div>
 
    <div class="field">
      <label>Titre</label>
      <input type="text" id="titre" name="titre">
      <span class="error"></span>
    </div>
 
    <div class="field">
      <label>Message</label>
      <input type="message" id="texte" name="message">
      <span class="error"></span>
    </div>
 
    <button type="submit">envoyer</button>
  </form>
</body>
</html>