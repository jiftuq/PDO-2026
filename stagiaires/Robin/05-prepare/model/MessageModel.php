<?php 
# stagiaires/Robin/05-prepare/model/MessageModel.php

// C'est ici que l'on traitera les données de la table message

// Insertion d'un message dans la DB 
function insertMessage(PDO $db, string $mail, string $message): bool
{

// On va protéger nos variables utilisateurs contre les failles xss ou erreurs
    $mail = filter_var($mail,FILTER_VALIDATE_EMAIL);
    # Le message ne peut avoir ni tags
    $message = strip_tags($message);
    # Ni espace avant / arrière
    $message = trim($message);
    # On encode les caractères dangereux en entités html
    $message = htmlspecialchars($message);

    // Ou $message = htmlspecialchars(trim(strip_tags($message)));

// Si au moins une des variables n'est pas valide
    # Vérification si il y a un problème
 if($mail === false || empty($message)){
        #Envoi de false et arrêt de la fonction
        return false;
    } 

    # Entrées utilisateur = requête préparée 
    # avec Marqueur nommé (:mot)
    $prepare = $db->prepare("
    INSERT INTO `message` (`email_message`,`texte_message`)
        VALUES(:email, :text);
    ");
   # On met nos valeurs dans la requête
   $prepare->bindValue(':email',$mail);
   $prepare->bindValue(':text',$message);
   # on va exécuter la requête
   $retour = $prepare->execute();

   return $retour; // True en cas de réussite, false en cas d'échec

   // var_dump($db,$mail, $message);
}

// Affichage des messages depuis la DB
function selectAllMessage(PDO $connect): array 
{
    // Pas besoin de requête préparée car pas d'entrée utilisateur
    $stmt = $connect->query("SELECT * FROM `message` ORDER BY `date_message` DESC");
    // On envoi un tableau avec les résultats 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Bonne pratique
    $stmt->closeCursor();
    // Appel de la vue
    return $result;
}