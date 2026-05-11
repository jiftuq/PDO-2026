<?php
// Ce fichier contient les fonctions pour gérer la table livre

// ============================================================
// FONCTION : Ajouter un commentaire dans la base de données
// ============================================================
function insertLivre(PDO $con, array $datas): bool
{
    // On vérifie que l'email est valide
    // filter_var retourne false si l'email est incorrect
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    // On nettoie le titre (supprime les balises HTML et les espaces)
    $title = strip_tags($_POST['title']);
    $title = trim($title);
    $title = htmlspecialchars($title);

    // On nettoie le texte du commentaire
    $text = htmlspecialchars(trim(strip_tags($_POST['text'])));

    // Si un des champs est invalide ou vide, on arrête et on retourne false
    if ($email === false || empty($title) || empty($text)) {
        return false;
    }

    // On prépare la requête SQL d'insertion
    $sql = "INSERT INTO `livre` (`email`, `title`, `text`)
            VALUES (:mail, :titre, :dutexte)";

    $prepare = $con->prepare($sql);

    // On associe les valeurs aux marqueurs (:mail, :titre, :dutexte)
    $prepare->bindValue(":mail",     $email);
    $prepare->bindValue(":titre",    $title);
    $prepare->bindValue(":dutexte",  $text);

    // On exécute la requête
    $prepare->execute();

    // rowCount() retourne le nombre de lignes insérées
    // Si c'est 1, l'insertion a réussi
    if ($prepare->rowCount() === 1) {
        return true;
    } else {
        return false;
    }
}


// ============================================================
// FONCTION : Compter le nombre total de commentaires
// ============================================================
function countLivres(PDO $con): int
{
    // COUNT(*) compte toutes les lignes de la table
    $stmt  = $con->query("SELECT COUNT(*) FROM `livre`");
    $total = (int) $stmt->fetchColumn();
    return $total;
}


// ============================================================
// FONCTION : Récupérer les commentaires d'une page
// ============================================================
// $limit  = nombre de commentaires à afficher par page (ex: 5)
// $offset = à partir de quel commentaire on commence (ex: 0, 5, 10...)
function readLivres(PDO $con, int $limit, int $offset): array
{
    // LIMIT  = combien de lignes on veut
    // OFFSET = combien de lignes on saute
    // On insère directement les entiers dans la requête car ce sont des int (pas de risque d'injection SQL)
    $sql  = "SELECT * FROM `livre` ORDER BY `datetime` DESC LIMIT $limit OFFSET $offset";
    $stmt = $con->query($sql);

    // fetchAll retourne tous les résultats sous forme de tableau
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $livres;
}
