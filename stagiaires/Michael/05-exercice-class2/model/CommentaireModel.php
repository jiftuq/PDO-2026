<?php

// utilisez le typage si possible

function addCommentaire(){

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