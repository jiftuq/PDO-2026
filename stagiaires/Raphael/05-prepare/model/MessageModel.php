<?php


// C'est ici que l'on traitera les données de la table message


// Insertion d'un message dans la DB
function insertMessage(PDO $db,string $mail, string $message): bool{

    // on va protegéger nos variables utilisateur contre les failles xss ou erreurs
        # contient un mail valide ou vaut false(bool)
        $mail = filter_var($mail,FILTER_VALIDATE_EMAIL);
        # Le message ne peut avoir ni tags,  
        $message = strip_tags($message);
        # ni espace avant ou après,
        $message = trim($message);
        # conversion des caractères spéciaux dangereux pour le XSS en entités html
        $message = htmlspecialchars($message);
        // ou $message = htmlspecialchars(trim(strip_tags($message)));
        
    // si au moins une des variables n'est pas valide
        # vérification si il y a un probleme
        if($mail===false || empty($message))
                         # envoi de false et arrêt de la fonction
                         return false;

        // Entrées utilisateur = requête préparée
            # avec marqueur nommé (:mot)
            $prepare = $db->prepare("INSERT INTO `message` (`email_message`,`texte_message`) VALUES (:email, :texte);");
            # on met nos valeurs dans la requête préparée
            $prepare->bindValue(':email',$mail);
            $prepare->bindValue(':texte',$message);
            # on exécute la requête
            $retour = $prepare->execute();
    //var_dump($db,$mail,$message);
            return $retour; // true en cas de réussite, false en cas d'échec
}

// affichage des messages depuis la DB
function selectAllMessage(PDO $lulu): array{
    // Pas besoin de requête préparée car pas d'entrée utilisateur
    $stmt = $lulu->query("SELECT * FROM `message` ORDER BY `date_message` DESC");    
    // tableau avec les résultats
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Bonne pratique
    $stmt->closecursor();
    // retour du tableau
    return $result;
}