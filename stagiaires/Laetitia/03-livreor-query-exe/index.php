<?php

// Chargement de nos constantes de connexion
require_once 'config-dev.php';

// Tentavive de connexion
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // Arrêt et affichage de l'erreur
    die($e->getMessage());
}

// On vérifie si on a envoyé le formulaire
if (isset($_POST['email_message'],$_POST['texte_message'])){
    // On va créer des variables de traitements :
    # Retourne le mail (string) si valide via expression régulière, sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL);
    # On retire les balises html pour sécurisé la chaîne (! très sécure seulement si on ne permet aucune balises
    # l'htmlspecialchars est hautement recommandée)
    $text = strip_tags($_POST['texte_message']);

    # On retire les espaces vides devant et derrière la chaîne
    $text = trim($text);

    # On convertit les caractères spéciaux dangereux pour injerctionsSQL et/ou XSS en entité html
    $text = htmlspecialchars($text);

    #echo nl2br($text);

    #var_dump($email, $text);

    // Si le mail ne vaut pas (strictement) false et que le texte n'est pas vide
    if ($email!==false && $text!==""){

    // Préparation de la requête pour s'habituer ;)
        $sql = "INSERT INTO `message` (`email_message`,`texte_message`)
        VALUES ('$email','$text')";
        // Exécution de l'insertion qui contiendra le nombre de lignes affectées par la requête
        $nb_affected_line = $connectDB->exec($sql);

        // Si au moins une ligne est afféctée (1==true, 0==false)
        if($nb_affected_line==1)
            $thanks = "Merci pour l'ajout";
    }
}

// On récupère les messages
$request = $connectDB->query("SELECT * FROM `message`");

// On compte le nombre de message(s) affecté(s)/récupèré(s)
$nbMessage = $request->rowCount();

// Si pas de message
if($nbMessage===0){
    $message ="Pas encore de message(s)";
// On a, au moins, 1 message, mais probablement plus
}else{
    // On va récupérer les résultats dans un format gérable par PHP
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
}

$request->closeCursor();

$connectDB = null;

// var_dump($connectDB, $request, $nbMessage, $message);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or | Evénement ABC</title>
</head>
<body>
    <style>
        body{
            background: linear-gradient(to right, #ff7e5f, #feb47b);
        }

        input{
            margin: 1px;
        }
    </style>
    <h1>Livre d'Or</h1>
    <p>Merci de me laisser un message sur l'événement ABC</p>
    <?php
    if(isset($thanks)):
    ?>
    <h3><?= $thanks ?></h3>
    <script>
        setTimeout(()=> {
            window.location.href="./";
        }
        , "3000");
    </script>
    <?php
    endif;
    ?>
    <form action="" method="POST" name="Message">
        <input type="text" name="email_message" placeholder="Votre mail" /><br>
        <textarea name="texte_message" placeholder="Votre message"></textarea><br>
        <input type="submit" value="Envoyé" />
        <?php
        // var_dump($_POST);
        ?>
    </form>
    <div>
    <?php
    // Pas de message postés
    if(isset($message)):
    ?>
    <h3><?= $message ?></h3>
    <?php
    // On a au moins 1 message dans la table
    else:
        // Pour le pluriel
        $pluriel = $nbMessage > 1 ? "s" : "";
    ?>
    <h4>Nous avons <?= $nbMessage ?> message<?= $pluriel ?></h4>
    <?php
        // Tant qu'on a des messages
        foreach($results as $result):
    ?>
    <div class="reponse">
        <h5><?= $result['email_message'] ?> a écrit le <?= $result['date_message'] ?></h5>
        <p><?= nl2br(htmlspecialchars($result['texte_message'])); // Retour automatique à la ligne ?></p>
        <hr>
    </div>
    <?php
        endforeach;
    endif;
    ?>
    </div>
</body>
</html>