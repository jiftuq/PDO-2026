<?php
# stagiaires/Laetitia/05-prepare/model/MessageModel.php

// C'est ici que l'on traitera les données de la table message

// Insertion d'un message dans la DB
function insertMessage(PDO $db, string $mail, string $message): bool
{

    // On va proteger nos variables utilisateurs contre les failles xss ou erreurs
    # mail contient un mail valide ou vaut false (bool)
    $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
    # Le message ne peut avoir ni tags,
    $message = strip_tags($message);
    // Ni epsace avant après,
    $message = trim($message);
    // Ni caractères dansgereux
    $message = htmlspecialchars($message);

// Si au moins une des variables n'est pas valide
    # Vérification, si il y a un problème
    if($mail===false || empty($message))
        # Envoi de false et arrêt de la fonction
        return false;

    // Entreés utilisateurs = requête préparée
    $prepare = $db->prepare("INSERT INTO `message` (`email_message`, `texte_message`)
        VALUES (:email, :text);
    ");
    # on met nos valeurs dans la requête préparé
    $prepare->bindValue(':email', $mail);
    $prepare->bindValue(':text', $message);
    # On exécute la requête
    $retour = $prepare->execute();
    return $retour; // True en cas de réussiten false en cas d'echec

    // var_dump($db, $mail, $message);
}

// Affichage des messages depuis la DB
function selectAllMessage(PDO $connect): array
{
    // Pas besoin de requête préparée car pas d'entrée utilisateur
    $stmt = $connect->query("SELECT * FROM `message` ORDER BY `date_message` DESC");
    // Tableau avec les résultats
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Bonne pratique
    $stmt->closeCursor();
    // Retour du tableau
    return $result;
}