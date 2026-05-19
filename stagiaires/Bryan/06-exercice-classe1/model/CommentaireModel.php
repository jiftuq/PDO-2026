<?php
// stagiaires/Michael/06-exercice-classe1/model/CommentaireModel.php

/**
 * Ajoute un commentaire dans la base de données.
 *
 * @param PDO    $pdo
 * @param string $email
 * @param string $fullName
 * @param string $title
 * @param string $textComment
 * @return bool
 */
function addCommentaire(PDO $pdo, string $email, string $fullName, string $title, string $textComment): bool
{
    $sql = "INSERT INTO commentaire (email, full_name, title, text_comment)
            VALUES (:email, :full_name, :title, :text_comment)";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':email' => $email,
        ':full_name' => $fullName,
        ':title' => $title,
        ':text_comment' => $textComment,
    ]);
}

/**
 * Retourne tous les commentaires, du plus récent au plus ancien.
 *
 * @param PDO $pdo
 * @return array
 */
function readAllCommentaires(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM commentaire ORDER BY post_date DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retourne le nombre total de commentaires.
 *
 * @param PDO $pdo
 * @return int
 */
function countAllCommentaires(PDO $pdo): int
{
    $stmt = $pdo->query("SELECT COUNT(*) FROM commentaire");
    return (int) $stmt->fetchColumn();
}

// ── BONUS : pagination ────────────────────────────────────────────────────────

/**
 * Retourne une page de commentaires.
 *
 * @param PDO $pdo
 * @param int $page   Numéro de page (commence à 1)
 * @param int $nbByPage Nombre d'éléments par page (défaut : NB_BY_PAGE)
 * @return array
 */
function readPaginationCommentaires(PDO $pdo, int $page = 1, int $nbByPage = NB_BY_PAGE): array
{
    $offset = ($page - 1) * $nbByPage;

    $stmt = $pdo->prepare(
        "SELECT * FROM commentaire
         ORDER BY post_date DESC
         LIMIT :limit OFFSET :offset"
    );
    $stmt->bindValue(':limit', $nbByPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
