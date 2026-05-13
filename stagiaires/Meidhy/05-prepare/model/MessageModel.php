<?php
/* stagiaires/Meidhy/05-prepare/model/MessageModel.php
c'est ici que l'on traitera les données de la table message */

// insertion dans la DB 
function insertMessage(PDO $db, string $mail, string $message): bool
{
    
/* on va protéger nos variables utilisateurs contre les failles XSS ou erreurs 
    mail contient un mail valide ou vaut false (bool)*/
    $mail = filter_var($mail,FILTER_VALIDATE_EMAIL);

    // Le message ne peut avoir ni tags 
    $message = strip_tags($message);

    //ni espace avant/après
    $message = trim($message);
    
    // ni charactères dangereux (conversion)
    $message = htmlspecialchars($message);

    /* si au moins 1 des variables n'est pas valide
    Vérification si il y a un problème, on envoie false 
    et arret de la fonction */ 
    if($mail === false || empty($message))   
                        return false; 

    //ou en 1 ligne 
    // htmlspecialchars(trim(stripe_tags($message))); 
    
    /* Entrée utilisateurs = requete préparée 
    avec marqueurs nommé (:mot) */
    $prepare = $db->prepare("INSERT INTO `message`(`email_message`, `texte_message`)
        VALUES (:email, :text);
    "); 

    // on mets nos valeurs dans la requete preparée 
    $prepare->bindValue(':email', $mail);
    $prepare->bindValue(':text', $message);

    // on éxecute la requête 
    $retour = $prepare->execute(); 

    return $retour; // true en cas de réussite, sinon false 
};

// affichage des messages depuis la DB 
function selectAllMessage(PDO $connect): array{
    
    // pas besoin de requete preparée car pas d'entrée user
    $stmt = $connect->query("SELECT * FROM `message` 
    ORDER BY `date_message` DESC");
    
    // tableau avec les résultats 
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
    // Bonne pratique
    $stmt->closeCursor();

    // retour au tableau 
    return $result;

};