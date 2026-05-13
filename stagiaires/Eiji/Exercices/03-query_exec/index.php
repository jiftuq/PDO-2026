<?php

// chargement de la confiqguration de la DB
require_once './config-dev.php';

// tentative de connexion 
try {
    $db = new PDO(
        dsn: MARIA_DSN,
        username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
    );

    // bonne pratique utilisons -Exception plutôt que -PDOException
// => Pour n'utiliser qu'un seul gestionaitr d'errer
} catch (Exception $e) {
    die("Numéro d'erreur {$e->getCode()} <br> Message d'erreur {$e->getMessage()}");
}

// si on a envoyé le formulaire
if(isset($_POST['email'],$_POST['title'],$_POST['text'])){
    // en principe, dès qu'on a des entrées utilisateurs, on fera des requêtes préparé (pas mtn)
        // mtn on va utliser le -exec
        # on protège nos varibles
        $mail = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);

        // avec cette ligne de code, on peut proteger de toutes injection de code/ script
        $title= htmlspecialchars(trim(strip_tags($_POST['title'])));

        $text= htmlspecialchars(trim(strip_tags($_POST['text'])));
        // si au moins un champs n'est pas valide
        if($email===false || empty($title) || empty($text)){
            $erreur = "Bien essayé, <a href='javascript:history.go(-1)'>recommence</a>";
        }else{
            $db->exec("INSERT INTO `livre` (`email`,`title`,`text`) VALUES (`$email`,`$title`,`$text`);");
        }
}

// on va récupérer tous les messages
$sql = "SELECT * FROM `livre` ORDER BY `datetime` ASC;";
$request = $db->query($sql);

// on va compter le emailbre de résultat
$nbArticle = $request->rowCount();

// si pas au moins un article 
if ($nbArticle === 0){
    $message = "Pas encore de commentaires";
}elseif ($nbArticle === 1){
    $message = "Nous avons $nbArticle commentaire";
}else{
    $message = "Nous avons $nbArticle commentaire";
}

// pour la bonne pratique, tjrs avant de fermer son PHP ↓
// bonne pratique
$request->closeCursor();
// bonne pratique DB
$db = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
            padding: 10px;
            margin: 0 auto;
        }

        textarea{
                margin-bottom: 10px;
        }

        label{
            display:block;
        }

        form{
            display: flex;
            background-color: blue;
            color: aliceblue;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            width: 60%;
            gap: 20px;
            height: 30%;
            flex-direction: column;
            margin: 0 auto;
        }

        form{
            label{
                width: 100%;
            }
            input{
                width: 75%;
            }

            #bouton{
                width: 50%;
                margin-top: 20px;
            }
        }
            </style>
        </head>

        <body>
            <h1><strong>LIVRE D'OR</strong></h1>
            <form method ='POST'>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required>

                <label for="title">Title :</label>
                <input type="text" name="mail" id="title" required>

                <label for="text">Text :</label>
                <input type="text" name="text" id="text" required>

                <input type="submit" value="ENVOYER" id="submit">    

            </form>
        </body>

        </html>