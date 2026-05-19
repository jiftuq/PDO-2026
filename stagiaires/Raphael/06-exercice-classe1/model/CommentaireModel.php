<?php
# stagiaires/Michael/06-exercice-classe1/model/CommentaireModel.php

// utilisez le typage si possible

function addCommentaire(PDO $db,string $email, string $fullName, string $title, string $text_comment): bool{

    // on va protegéger nos variables utilisateur contre les failles xss ou erreurs
        # contient un mail valide ou vaut false(bool)
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        # Le message ne peut avoir ni tags,  
        $fullName = htmlspecialchars(trim(strip_tags($fullName)));
        $title = htmlspecialchars(trim(strip_tags($title)));
        $text_comment = htmlspecialchars(trim(strip_tags($text_comment)));

        if (mb_strlen($email) > 120) {
        return false;
    }   
        if (mb_strlen($fullName) < 5 || mb_strlen($fullName) > 120) {
        return false;
    }
         if (mb_strlen($title) < 5 || mb_strlen($title) > 180) {
        return false;
    }
        if (mb_strlen($text_comment) < 5 || mb_strlen($text_comment) > 1000) {
        return false;
    }
        
    // si au moins une des variables n'est pas valide
        # vérification si il y a un probleme
        if($email===false || empty($fullName) || empty($title) || empty($text_comment))
                         # envoi de false et arrêt de la fonction
                         return false;

        

        // Entrées utilisateur = requête préparée
            # avec marqueur nommé (:mot)
            $prepare = $db->prepare("INSERT INTO `commentaire` (`email`,`full_name`,`title`,`text_comment`) VALUES (:email, :full_name, :title, :text_comment );");
            # on met nos valeurs dans la requête préparée
            $prepare->bindValue(':email',$email);
            $prepare->bindValue(':full_name',$fullName);
            $prepare->bindValue(':title',$title);
            $prepare->bindValue(':text_comment',$text_comment);
            # on exécute la requête
            $retour = $prepare->execute();
    //var_dump($db,$mail,$message);
            return $retour; // true en cas de réussite, false en cas d'échec
}

function readAllCommentaires(PDO $db): array{
    $request = $db->query("SELECT * FROM `commentaire` ORDER BY `post_date` DESC");
    return $request->fetchALL(PDO::FETCH_ASSOC);
}

function countAllCommentaires(PDO $db): int
{
    $request = $db->query("
        SELECT COUNT(*) AS total
        FROM `commentaire`
    ");

    $result = $request->fetch(PDO::FETCH_ASSOC);

    return (int) $result['total'];
}

// bonus pagination


function readPaginationCommentaires(){

}