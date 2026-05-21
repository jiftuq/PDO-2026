<?php

function addCommentaire(PDO $connectDB, string $email, string $full_name, string $title, string $text_comment): void
{
    $sql = "INSERT INTO commentaire (email, full_name, title, text_comment) 
            VALUES (:email, :full_name, :title, :text_comment)";
    $stmt = $connectDB->prepare($sql);
    $stmt->execute([
        ':email'        => $email,
        ':full_name'    => $full_name,
        ':title'        => $title,
        ':text_comment' => $text_comment,
    ]);
}

function readAllCommentaires(PDO $connectDB): array
{
    $sql  = "SELECT * FROM commentaire ORDER BY post_date DESC";
    $stmt = $connectDB->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAllCommentaires(PDO $connectDB): int
{
    $sql  = "SELECT COUNT(*) FROM commentaire";
    $stmt = $connectDB->prepare($sql);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
}

function readPaginationCommentaires(PDO $connectDB, int $page, int $nb_by_page): array
{
    $offset = ($page - 1) * $nb_by_page;
    $sql    = "SELECT * FROM commentaire ORDER BY post_date DESC LIMIT :limit OFFSET :offset";
    $stmt   = $connectDB->prepare($sql);
    $stmt->bindValue(':limit',  $nb_by_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset,     PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}