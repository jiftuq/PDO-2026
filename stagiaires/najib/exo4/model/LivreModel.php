<?php
// Ce fichier contiendre les fonctions
// pour gérer la table livre (future class en OO)

// fonction d'insertion
function insertLivre(PDO $con, array $datas): bool
{
    // $_POST['email'],$_POST['title'],$_POST['text']
    // traitement des variables $_POST en variables locales
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL); // false si incorrecte, le mail en string si correcte

    // on retire tout les tags
    $title = strip_tags($_POST['title']);
    // on retire les espaces avant et arrière
    $title = trim($title);
    // On encode les caractères dangereux en entités html
    $title = htmlspecialchars($title);

    $text = htmlspecialchars(trim(strip_tags($_POST['text'])));

    // si au moins un des champs n'est pas valide
    if($email === false || empty($title) || empty($text)){
        // on arrête le script
        return false;
    }

    // on va préparer notre requête avec des marqueurs nommés (:nom)
    $sql = "INSERT INTO `livre` 
            (`email`,`title`,`texte`) 
            VALUES (:mail,:titre,:dutexte);";
    // attente des valeurs de marqueurs        
    $prepare = $con->prepare($sql);    
    // on va utiliser le bindValue() par défaut
    $prepare->bindValue(":mail",$email);
    $prepare->bindValue(":dutexte",$text);
    $prepare->bindValue(":titre",$title);
    // on va exécuter la requête
    $prepare->execute();
    // si on a bien insérer 1 ligne
    return $prepare->rowCount()===1 ? true : false;

}


function readLivres(PDO $con): array
{
    // on va récupérer tous les messages
    $sql = "SELECT * FROM `livre` ORDER BY `datetime` ASC";
    $request = $con->query($sql);

    // transformation du ou des résultat en tableau indexé contenant des tableaux associatifs
    $articles = $request->fetchAll(PDO::FETCH_ASSOC);

    // bonne pratique
    $request->closeCursor();

    return $articles ?: [];
}