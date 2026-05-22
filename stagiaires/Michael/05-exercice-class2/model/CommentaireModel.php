<?php

// utilisez le typage si possible

// ajout d'un commentaire
function addOneCommentaire(PDO $db, string $email, string $full_name, string $title, string $text_comment): bool
{
    // traitement des variables
    $email=filter_var($email,FILTER_VALIDATE_EMAIL);
    $text_comment=htmlspecialchars(trim(strip_tags($text_comment)));
    $full_name = htmlspecialchars(trim(strip_tags($full_name)));
    $title = htmlspecialchars(trim(strip_tags($title)));
    
    // on envoie false si il y a une seule erreur
      if($email===false           ||
    strlen($email)>120            ||
    empty($full_name)             ||
    strlen($full_name)<5          ||
    strlen($full_name)>120        ||
    empty($title)                 ||
    strlen($title)<5              ||
    strlen($title)>180            ||
    empty($text_comment)          ||
    strlen($text_comment)<5       ||
    strlen($text_comment)>1000   
    ) return false;

    // préparation de la requête avec des marqueurs non nommés
    $stmt = $db->prepare("INSERT INTO `commentaire` (`email`, `full_name`, `title`, `text_comment`) VALUES (?,?,?,?);");
    // attribution des variables
    $stmt->bindValue(1,$email,PDO::PARAM_STR);
    $stmt->bindValue(2,$full_name);
    $stmt->bindValue(3,$title);
    $stmt->bindValue(4,$text_comment);

    // insertion
    $insert = $stmt->execute();
    // bonne pratique
    $stmt->closeCursor();
    // return envoi true si réussi, false en cas d'échec
    return $insert;
}

// chargement de tous les commentaires
function readCommentaires(PDO $db): array
{
    // requête
    $stmt = $db->query("SELECT * FROM `commentaire` ORDER BY `post_date` DESC");
    // recupération des resultats en fetch_assoc (voir connexion)
    $result = $stmt->fetchAll();
    // bonne pratique
    $stmt->closeCursor();
    // retour
    return $result;
}

// bonus pagination

function countCommentaires(){
    
}