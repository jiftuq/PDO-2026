<?php
//chargement de nos const de connexion
require_once 'config-dev.php';

// tentative de connexion
try {
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
} catch (Exception $e) {
    // arrêt et affichage de l'erreur (ev dev)
    die($e->getMessage());
}
// on vérifie si on a envoyé le formulaire
if (isset($_POST['email_message'], $_POST['texte_message'])) {
    //on va créer de var de traitement:
    # retorne le mail si valide via expression régulière, sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL);

    # on retire les balises html pour sécuriser la xhaine (! très sécure seulement
    #si on ne permet aucune balise, l'htmlspecialchar est hautement recommandée )
    $text = strip_tags($_POST['texte_message']);

    # on retire les espaces vides devant et derrière la chaine
    $text = trim($text);

    # on convertit les carectères spéciaux  dangereux pour injectionSQL et/ou XSS
    # en entité($text)

    $text = htmlspecialchars($text);

    // si le mail ne vaut pas (strictement) false ET que  le texte est vide
    if ($email !== false  && $text !== "") {

        //preparation de la requete (pour s'habituer ;-)
        $sql = "INSERT INTO `message`(`email_message`,`texte_message`)
                VALUES ('$email' ,'$text');";

        // exécution de l'insertion qui contiendra le nombre de ligne affectées par la requete
        $nb_affected_line = $connectDB->exec($sql);

        // si au mois une ligne est affecteé (1== true 0== false)
        if ($nb_affected_line) $thanks = "Merci pour l'ajout!";
    }
}
// on récupére les messages
$request = $connectDB->query("SELECT * FROM `message`");

// on compte le nobre de message(s) affecté(s) ici récupéré(s)
$nbMessage = $request->rowCount();
// si pas de message 
if ($nbMessage === 0) {
    $message = "Pas encore de message";

    // on a au moins 1 message, mais probalement plus
} else {
    // on va récupérer les résultats dans un format gérable par  PHP
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
}
$request->closeCursor();

$connectDB = null;

// var_dump($connectDB,$request,$nbMessage,$message);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <style>
*{
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}
 
body{
    margin: 0;
    background: #f2f4f8;
    text-align: center;
    padding-top: 50px;
    color: #333;
}
 
form{
    margin: 20px auto;
    background: white;
    width: 350px;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: left;
}
 
input, textarea{
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 8px 10px;
    font-size: 14px;
    outline: none;
    transition: 0.2s;
    margin-bottom: 10px;
    &:focus{
        border-color: #4a90e2;
    box-shadow: 0 0 5px rgba(74,144,226,0.3);
    }
}
 
textarea{
    height: 80px;
    resize: none;
}
 
input[type="submit"]{
    background-color: #4a90e2;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    margin-top: 5px;
    transition: 0.3s;
    &:hover{
        background-color: #357bd8;
    }
}
 
</style>
 

</head>

<body>
    <h1>Livre d'or | Evénement ABC</h1>
    <p>Merci de me laisser un message sur l'événement ABC</p>
    <?php
    if (isset($thanks)):
    ?>
        <h3><?= $thanks ?></h3>
        <script>
            setTimeout(() => {
                window.location.href = "./";
            }, "3000")
        </script>
    <?php
    endif
    ?>
    <form action="" method="POST" name="message">
        <input type="text" name="email_message" placeholder="Votre mail"> <br>
        <textarea name="texte_message" placeholder="Votre message"></textarea> <br>
        <input type="submit" value="Envoyer">
        <?php
        // var_dump($_POST);
        ?>
    </form>
    <div>
        <?php
        // pas de message postés
        if (isset($message)):
        ?>
            <h3>
                <?= $message ?>
            </h3>
        <?php

        else:
            //pour le pluriel
            $pluriel = $nbMessage > 1 ? "s" : "";
        ?>
            <h4>Nous avons <?= $nbMessage ?> message<?= $pluriel ?></h4>
            <?php

            foreach ($results as $result):
            ?>

                <div class="reponse">
                    <h5> <?= $result['email_message'] ?> a écrit à <?= $result['date_message'] ?></h5>
                    <p><?= nl2br(htmlspecialchars($result['texte_message'])); // retour automatique à la ligne 
                        ?></p>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</body>

</html>