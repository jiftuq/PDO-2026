<?php
# stagiaires/Michael/06-exercice-classe1/model/CommentaireModel.php

// utilisez le typage si possible

function addCommentaire(PDO $db,string $email,string $text_comment,string $title,string $full_name):bool{
    $email=filter_var($email,FILTER_VALIDATE_EMAIL);
    $text_comment=htmlspecialchars(trim(strip_tags($text_comment)));
    $full_name = htmlspecialchars(trim(strip_tags($full_name)));
    $title = htmlspecialchars(trim(strip_tags($title)));
    
      if($email===false             ||
    strlen($email)>120            ||
    empty($full_name)            ||
    strlen($full_name)<5         ||
    strlen($full_name)>120        ||
    empty($title)                 ||
    strlen($title)<5              ||
    strlen($title)>180           ||
    empty($text_comment)          ||
    strlen($text_comment)<5       ||
    strlen($text_comment)>1000   
    ) return false;
 
    
    $prepare = $db->prepare("
    INSERT INTO `commentaire`(`email`,`text_comment`,`full_name`,`title`)
    VALUES(:email,:text_comment,:full_name,:title); 
    ");
    # on met nos val dans 
    $prepare->bindValue(':email',$email);
    $prepare->bindValue(':text_comment',$text_comment);
    $prepare->bindValue(':full_name',$full_name);
    $prepare->bindValue(':title',$title);

    # on exécute la requete
   $retour=$prepare->execute();
   return $retour; // true en cas de réussite, false en cas d'échec

//   var_dump($db,$mail,$message);
}

function readAllCommentaires(PDO $connect): array{
$stmt=$connect->query("SELECT * FROM `commentaire` ORDER BY `post_date` DESC");
// un tableau avec les results
$result= $stmt-> fetchAll(PDO::FETCH_ASSOC);

// Bonne pratique 
$stmt->closeCursor();
// retour du tableau
 return $result;
}

function countAllCommentaires(PDO $db): int{
    
        $stmt = $db->query("SELECT COUNT(*) FROM commentaire");
        return (int) $stmt->fetchColumn();
    }

// bonus pagination


function readPaginationCommentaires(){

}