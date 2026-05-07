<?php

// Chargement de nos constantes de connexion
require_once 'config-dev.php';

// Tentative de connexion
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// On vérifie si on a envoyé le formulaire
if(isset($_POST['email_message'],$_POST['texte_message'])){

    // On va Créer des variables de traitement :

    # Retourne le mail (string) si valide via expression régulière, sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL);

    # On retire les balise html pour sécuriser la chaîne attention (! très sécure seulement
    # si on ne permet aucune balise, l'htmlspecialchars est hautement recommandé)
    $text = strip_tags($_POST['texte_message']);

    # On retire les espaces vides devant et derrière la chaîne
    $text = trim($text);

    # On convertit les caractères spéciaux dangereux pour injection SQL et/ou XSS
    # en entité html
    $text = htmlspecialchars($text);

    #echo nl2br($text);

    #var_dump($email,$text);

    // Si le mail ne vaut pas false ET que le texte n'est pas vide
    if ($email!==false &&  $text!==""){
        // préparation de la requète (pour s'habituer ;-)
        $sql = "INSERT INTO `message` (`email_message`,`texte_message`)
        VALUE ('$email','$text');";
        // Execution de l'insertion qui contiendra le nombre
        // de ligne affectées pas la requête
        $nb_affected_line = $connectDB->exec($sql);
        
        // on veut récupérer  le dernier id inserer (par vous)
        $last_insert_id = $connectDB->lastInsertId();

        // si au moins une ligne est affectée (1 == true, 0 == false)
        if($nb_affected_line)
            $thanks = "Merci pour l'ajout de l'ID $last_insert_id : $nb_affected_line ligne";

    }

}


// On récupère les messages
$request = $connectDB->query("SELECT * FROM `message` ORDER BY `date_message` DESC;");

// On compte le nombre de message(s) affecté(s) ici récupéré(s)
$nbMessage = $request->rowCount();

// si pas de message
if($nbMessage === 0){
    $message = "Pas encore de message";

// On a au moins 1 message, mais probablement plus
}else{
    // on va récupérer les résultats dans un format gérable par PHP
    $results = $request->fetchALL(PDO::FETCH_ASSOC);
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
    <h1>Livre d'oir</h1>
    <p>Merci de me laisser un message sur l'événement ABC</p>
    <?php
    if(isset($thanks)):
    ?>
    <h3><?=$thanks?></h3>
    <script>
        setTimeout(() => {
            window.location.href="./";
        }
            , "3000");
    </script>
    <?php
    endif;
    ?>
    <form action="" method="POST" name='Message'>
        <input type="text" name="email_message" placeholder="Votre mail" /><br>
        <textarea name="texte_message" placeholder="Votre message"></textarea><br>
        <input type="submit" value="Envoyer">
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
        // Pour le pluriel
        $pluriel = $nbMessage > 1 ? "s" : "";
    ?>
    <h3>Nous avons <?= $nbMessage ?> message<?=$pluriel?></h3>
    <?php
        // Tant qu'on a des messages
        foreach($results as $result):
    ?>
    <div class="reponse">
        <h5>ID : <?= $result['id_message'] ?> | <?= $result['email_message'] ?> a écrit à <?= $result['date_message'] ?></h5>
        <p><?= nl2br($result['texte_message']); // retour automatique à la ligne ?></p>
        <hr>
    </div>
    <?php
        endforeach;
    endif;
    ?>
    </div>
</body>
</html>