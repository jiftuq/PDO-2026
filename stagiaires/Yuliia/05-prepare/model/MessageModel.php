<?php
# stagiaires/Yuliia\05-prepare/model/MessageModel.php

// c'est ici que l'on traitera les données de la table massage

// insertion d'un message dans la DB
function insertMassage(PDO $db,string $mail,string $message): bool
{
    // on vaprotéger nos var utilisateurs contre les failles XSS ou erreurs 
    #mail contient un mail valide ou false (bool)
          $mail=filter_var($mail,FILTER_VALIDATE_EMAIL);
     # Le message ne peut avoir ni tags
     $message=strip_tags($message);
     # ni espce avant après
     $message=trim($message);
     # ni caractèrs, conversion de caractèrs dangereux pour le XSS en éntetites html
     $message=htmlspecialchars($message);
    // ou $message=htmlspecialchars(trim(strip_tags($message)));

    // si au moins 1 des var n'est pas valide 
        # vérification, si il y a un probleme
        if($mail==false || empty($message)) return false; // on envoi de false et arret de la function 


    // Entrées utilisateur = requête préparée 
        # avec Marqueur nommé(:mot)
    $prepare = $db->prepare("
    INSERT INTO `message`(`email_message`,`texte_message`)
    VALUES(:email,:text); 
    ");
        # on met nos val dans 
        $prepare->bindValue(':email',$mail);
        $prepare->bindValue(':text',$message);
        # on exécute la requete
       $retour=$prepare->execute();
       return $retour; // true en cas de réussite, false en cas d'échec




    //   var_dump($db,$mail,$message);

    return "On insert";
  
}

// affichage des massages depuis la DB 
function selectAllMessages(PDO $connect): array
{
    // pas besoin de requete préparée par d'entrée utilisateur
$stmt=$connect->query("SELECT * FROM `message` ORDER BY `date_message` DESC");
// un tableau avec les results
$result= $stmt-> fetchAll(PDO::FETCH_ASSOC);

// Bonne pratique 
$stmt->closeCursor();
// retour du tableau
 return $result;
}