<?php
// 05-exercice/controller/routerController.php

require_once ROOT_PROJECT . '/model/CommentaireModel.php';

function getPdo(): PDO
{
    try {
        $pdo = new PDO(MARIA_DSN, DB_CONNECT_USER, DB_CONNECT_PWD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'Erreur de connexion à la base de données.';
        exit;
    }
}

function homepage(): void
{
    require ROOT_PROJECT . '/view/homepage.html.php';
}

function addCommentaire(): void
{
    $errors = [];
    $old = [
        'email' => '',
        'full_name' => '',
        'title' => '',
        'text_comment' => '',
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $old['email'] = trim($_POST['email'] ?? '');
        $old['full_name'] = trim($_POST['full_name'] ?? '');
        $old['title'] = trim($_POST['title'] ?? '');
        $old['text_comment'] = trim($_POST['text_comment'] ?? '');

        if (empty($old['email']) || strlen($old['email']) > 120 || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email doit être valide et ne doit pas dépasser 120 caractères.';
        }

        if (mb_strlen($old['full_name']) < 5 || mb_strlen($old['full_name']) > 120) {
            $errors[] = 'Le nom complet doit contenir entre 5 et 120 caractères.';
        }

        if (mb_strlen($old['title']) < 5 || mb_strlen($old['title']) > 180) {
            $errors[] = 'Le titre doit contenir entre 5 et 180 caractères.';
        }

        if (mb_strlen($old['text_comment']) < 5 || mb_strlen($old['text_comment']) > 1000) {
            $errors[] = 'Le commentaire doit contenir entre 5 et 1000 caractères.';
        }

        if (empty($errors)) {
            insertCommentaire(getPdo(), $old['email'], $old['full_name'], $old['title'], $old['text_comment']);
            header('Location: ?page=commentaires');
            exit;
        }
    }

    require ROOT_PROJECT . '/view/add-comment.html.php';
}

function readCommentaires(): void
{
    $pdo = getPdo();
    $currentPage = max(1, (int)($_GET['p'] ?? 1));
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    $count = countCommentaires($pdo);
    $comments = [];
    if ($count > 0) {
        $comments = readCommentairesFromDb($pdo, $limit, $offset);
    }

    $totalPages = $count > 0 ? (int)ceil($count / $limit) : 1;
    require ROOT_PROJECT . '/view/comments.html.php';
}

