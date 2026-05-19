<?php

function insertCommentaire(PDO $pdo, string $email, string $fullName, string $title, string $textComment): bool
{
    $sql = 'INSERT INTO commentaire (email, full_name, title, text_comment) VALUES (:email, :full_name, :title, :text_comment)';
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':email' => $email,
        ':full_name' => $fullName,
        ':title' => $title,
        ':text_comment' => $textComment,
    ]);
}

function readCommentairesFromDb(PDO $pdo, ?int $limit = null, ?int $offset = null): array
{
    $sql = 'SELECT * FROM commentaire ORDER BY post_date DESC';
    if ($limit !== null) {
        $sql .= ' LIMIT :limit OFFSET :offset';
    }
    $statement = $pdo->prepare($sql);
    if ($limit !== null) {
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    }
    $statement->execute();
    return $statement->fetchAll();
}

function countCommentaires(PDO $pdo): int
{
    $sql = 'SELECT COUNT(*) FROM commentaire';
    $statement = $pdo->query($sql);
    return (int) $statement->fetchColumn();
}
