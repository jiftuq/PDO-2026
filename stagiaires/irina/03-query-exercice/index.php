<?php

// chargement de la configuration
// de la DB 
require_once 'config-dev.php';

// tentative de connexion
try{

    $bdd = new PDO(
        dsn: MARIA_DSN,
        username: DB_CONNECT_USER, 
        password: DB_CONNECT_PWD,
    );

// bonne pratique, utilisons Exception plutôt
// que PDOException (= 1 gestionnaire d'erreurs)
}catch(Exception $e){
    // pour concaténer de l'orienté objet, les {} sont fréquentes
    // die est comme exit, il permet d'arrêter le site en cas d'erreur
    die("Numéro d'erreur {$e->getCode()} <br> Message d'erreur {$e->getMessage()} ");
}

// si on a envoyé le formulaire
if(isset($_POST['email'],$_POST['title'],$_POST['text'])){
    // en principe, dès qu'on a des entrées utilisateurs
    // on fera des requêtes préparées
    // mais maintenant on va utiliser le exec
    # On protège nos variables
    $mail = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
    $text = htmlspecialchars(trim(strip_tags($_POST['text'])));
    // si au moins un champs n'est pas valide
    if($mail===false || empty($title) || empty($text)){
        $erreur = "Bien essayé, <a href='javascript:history.go(-1)'>recommence</a>";
    }else{
        // exécution de la requête
        $nbRow = $bdd ->exec("INSERT INTO `livre` (`email`,`title`,`text`) VALUES ('$mail','$title','$text');");
        // notre résultat vaut 1 ($nbRow==1; $nbrow==true;$nbRow)
    }
}

// on va récupérer tous les messages
$sql = "SELECT * FROM `livre` ORDER BY `datetime` ASC;";
$request = $bdd->query($sql);
// on va compter le nombre de résultat
$nbArticle = $request->rowCount();

// transformation  de ou des  résultats en tableau indexé contenant
// des tableaux associatifs ( lisible par PHP)
$articles = $request->fetchAll(PDO::FETCH_ASSOC);


// si pas au moins un article
if($nbArticle===0){
    $message = "Pas encore de commentaires";
}elseif($nbArticle===1){
    $message = "Nous avons $nbArticle commentaire";
}else{
    $message = "Nous avons $nbArticle commentaires";
}


// bonne pratique
$request->closeCursor();
// bonne pratique DB
$bdd = null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Livre d'or</title>
    


</head>
<body>
    <h1>Livre d'or</h1>
<?php if(isset($erreur)) echo $erreur ?>
<?php if (isset($reussite)) echo $reussite ?>
<form method='POST'>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="title">Titre</label>
    <input type="text" id="title" name="title" required>

    <label for="text">Message</label>
    <textarea id="text" name="text" required></textarea>

    <button type="submit">Envoyer</button>
  </form>
<div class='messages'>
    <h3><?= $message ?></h3>
     <?php
     foreach ($articles as $article):
        ?>
        <div class=" message">
            <h4><?= $article['title'] ?></h4>
            <p>Ecrite par <?= $article['email']?> le <?= date("d/m/Y\à H\hi",
            strtotime($article['datetime'])) ?> </p>
            <p> <?= htmlspecialchars($article['text']) ?></p>

        </div>
     <?php  
     endforeach; ?>
</div>
</body>
</html>