<?php
# stagiaires/Michael/05-prepare/model/MessageModel.php

// c'est ici que l'on traitera les données de la table message


// insertion d'un message dans la DB
function insertMessage(PDO $db, string $mail, string $message): bool
{

    // on va protéger nos variables utilisateurs contre les failles XSS ou erreurs
        # mail contient un mail valide ou vaut false (bool)
        $mail = filter_var($mail,FILTER_VALIDATE_EMAIL);
        # Le message ne peut avoir ni tags
        $message = strip_tags($message);
        # ni espace avant / arrière
        $message = trim($message);
        # conversion des caractères dangereux pour le XSS en entités html
        $message = htmlspecialchars($message);
        // ou $message = htmlspecialchars(trim(strip_tags($message)));

    // si au moins 1 des variables n'est pas valide
       # vérification, si il y a un probl!me
       if($mail===false || empty($message)) 
                        # envoi de false et arrêt de la fonction
                        return false;
    

    // Entrées utilisateur = requête préparée
        # avec Marqueur nommé (:mot)
        $prepare = $db->prepare("
        INSERT INTO `message` (`email_message`,`texte_message`)
            VALUES (:email, :text);
        ");
        # on met nos valeurs dans la requête préparée
        $prepare->bindValue(':email',$mail);
        $prepare->bindValue(':text',$message);
        # On exécute la requête
        $retour = $prepare->execute();

        return $retour; // true en cas de réussite, false en cas d'échec


    //var_dump($db,$mail,$message);
    
}


// affichage des messages depuis la DB
function selectAllMessage(PDO $connect): array
{
    // Pas besoin de requête préparée car pas d'entrée utilisateur
    $stmt = $connect->query("SELECT * FROM `message` ORDER BY `date_message` DESC");
    // Tableau avec les résultats
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Bonne pratique
    $stmt->closeCursor();
    // retour du tableau
    return $result;
}