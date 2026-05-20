<?php

// utilisez le typage si possible

function addCommentaire(PDO $con, array $datas){
    // $_POST['email'],$_POST['title'],$_POST['text']
    // traitement des variables $_POST en variables locales
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL); // false si incorrecte, le mail en string si correcte

    // on retire tout les tags
    $title = strip_tags($_POST['title']);
    // on retire les espaces avant et arrière
    $title = trim($title);
    // On encode les caractères dangereux en entités html
    $title = htmlspecialchars($title);
    // on retire tout les tags
    $fullName = strip_tags($_POST['fullName']);
    // on retire les espaces avant et arrière
    $fullName = trim($fullName);
    // On encode les caractères dangereux en entités html
    $fullName = htmlspecialchars($fullName);

    $text = htmlspecialchars(trim(strip_tags($_POST['text_comment'])));

    // si au moins un des champs n'est pas valide
    if($email === false || empty($title) || empty($text) || empty($fullName)){
        // on arrête le script
        return false;
    }

    // on va préparer notre requête avec des marqueurs nommés (:nom)
    $sql = "INSERT INTO `commentaire` 
            (`email`,`title`,`text_comment`,`full_name`) 
            VALUES (:mail,:titre,:dutexte,:fullName);";
    // attente des valeurs de marqueurs        
    $prepare = $con->prepare($sql);    
    // on va utiliser le bindValue() par défaut
    $prepare->bindValue(":mail",$email);
    $prepare->bindValue(":dutexte",$text);
    $prepare->bindValue(":titre",$title);
    $prepare->bindValue(":fullName",$fullName);
    // on va exécuter la requête
    $prepare->execute();
    // si on a bien insérer 1 ligne
    return $prepare->rowCount()===1 ? true : false;
}

function readCommentaires(PDO $con){
 // on va récupérer tous les messages
    $sql = "SELECT * FROM `commentaire` ORDER BY `post_date` ASC";
    $request = $con->query($sql);

    // transformation du ou des résultat en tableau indexé contenant des tableaux associatifs
    $articles = $request->fetchAll(PDO::FETCH_ASSOC);

    // bonne pratique
    $request->closeCursor();

    return $articles ?: [];}

// bonus pagination

function countCommentaires(PDO $con){

}