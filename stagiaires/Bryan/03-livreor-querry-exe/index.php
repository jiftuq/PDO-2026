<?php

//chargement de la configuration de la connexion à la base de données
require_once 'config-dev.php';

//tentative de connexion à la base de données
try {
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
} catch (Exception $e) {

    die($e->getMessage());
}
//requête de sélection de tous les messages
$request = $connectDB->query("SELECT * FROM `messages`");

//on compte le nombre de messages
$count = $request->rowCount();
// si pas de messages
if ($count === 0) {
    $msg = "Auncun message trouvé";
} else {
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
}
$request->closeCursor();

$connectDB = null;

//var_dump($connectDB, $request, $msg, $count);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <h1>Livre d'Or</h1>
    <p>Merci de laisser votre avis</p>
    <form action="" method="post" name="Message">
        <input type="" name="email_message" placeholder="Votre email" required>
        <textarea name="texte_message" placeholder="Votre message" required>
        </textarea>
        <input type="submit" value="Envoyer">
    </form>
    <?php
    if (isset($msg))
        ;
    ?>
    <h3><?= $msg ?></h3>
    <?php

    ?>
</body>

</html>