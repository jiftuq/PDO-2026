<?php

// chargement de nos constantes de connexion
require_once 'config-dev.php';

// tentative de connexion
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// on vérifie si on a envoyé le formulaire
if(isset($_POST['email_message'],$_POST['texte_message'])){

    // on va créer des variables de traitement :

    # retourne le mail (string) si valide via expression régulière, sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL);

    # on retire les balises html pour sécuriser la chaîne (! très sécure seulement
    # si on ne permet aucune balise, l'htmlspecialcahars est hautement recommandée)
    $text = strip_tags($_POST['texte_message']);

    # On retire les espaces vides devant et derrière la chaîne
    $text = trim($text);

    # On convertit les caractères spéciaux dangereux pour injectionsSQL et/ou XSS
    # En entité html
    $text = htmlspecialchars($text);

    // $text = htmlspecialchars(trim(strip_tags($_POST['texte_message'])));

    #echo nl2br($text);


    #var_dump($email, $text);

    // si le mail ne vaut pas (strictement) false ET que le texte n'est pas vide
    if($email!==false && $text!=""){
        
        // préparation de la requête (pour s'habituer ;-)
        $sql = "INSERT INTO `message` (`email_message`,`texte_message`) 
                VALUES ('$email','$text') ;";
        // exécution de l'insertion qui contiendra le nombre
        // de lignes affectées par la requête
        $nb_affected_line = $connectDB->exec($sql);

        // on veut récupérer le dernier id inséré (par vous sur 1 insertion)
        $last_insert_id = $connectDB->lastInsertId();
        
        // si au moins une ligne est affectée (1 == true, 0 ==false)
        if($nb_affected_line)
            $thanks = "Merci pour l'ajout de l'ID $last_insert_id  : $nb_affected_line ligne";
    }


}

// on récupère les messages
$request = $connectDB->query("SELECT * FROM `message` ORDER BY `date_message` DESC;");

// on compte le nombre de message(s) affecté(s) ici récupéré(s)
$nbMessage = $request->rowCount();

// si pas de message
if($nbMessage===0){
    $message ="Pas encore de message";

// on a au moins 1 message, mais probablement plus    
}else{
    // on va récupérer les résultats dans un format gérable par PHP
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
}

$request->closeCursor();

$connectDB = null;

// var_dump($connectDB,$request,$nbMessage,$message,$results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or | Evénement ABC</title>
</head>
<body>
    <h1>Livre d'or</h1>
    <p>Merci de me laisser un message sur l'événement ABC</p>
    <?php
    if(isset($thanks)):
    ?>
    <h3><?= $thanks ?></h3>
    <script>
        // redirection js
        setTimeout(() => {
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
        <input type="submit" value="Envoyer"/>
        <?php
        // var_dump($_POST);
        ?>
    </form>
    <div>
    <?php
    // Pas de messages postés
    if(isset($message)):
    ?>
    <h3><?= $message ?></h3>
    <?php
    // On a au moins un message dans la table
    else:
        // pour le pluriel
        $pluriel = $nbMessage > 1 ? "s" : "";
    ?>
    <h4>Nous avons <?=  $nbMessage ?> message<?= $pluriel ?></h4>
    <?php
        // tant qu'on a des message
        foreach($results as $result):
    ?>
    <div class="reponse">
        <h5>ID : <?=  $result['id_message'] ?> | <?= $result['email_message'] ?> a écrit à <?= $result['date_message'] ?></h5>
        <p><?= nl2br(htmlspecialchars($result['texte_message'])); // retour atomatique à la ligne ?></p>
        <hr>
    </div>
    <?php
        endforeach;
    endif;
    ?>
    </div>
</body>
</html>
