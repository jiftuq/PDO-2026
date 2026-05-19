<?php
// stagiaires/Michael/06-exercice-classe1/controller/routerController.php

// ── 1. Importer le modèle ────────────────────────────────────────────────────
require_once(ROOT_PROJECT . "/model/CommentaireModel.php");

// ── 2. Connexion PDO ─────────────────────────────────────────────────────────
try {
    $pdo = new PDO(MARIA_DSN, DB_CONNECT_USER, DB_CONNECT_PWD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// ── 3. Router (action GET/POST) ──────────────────────────────────────────────
$action = $_GET['action'] ?? 'home';

switch ($action) {

    // ── Affichage de la page d'accueil avec les commentaires ─────────────────
    case 'home':
    default:
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $commentaires = readPaginationCommentaires($pdo, $page);
        $total = countAllCommentaires($pdo);
        $totalPages = (int) ceil($total / NB_BY_PAGE);

        require_once(ROOT_PROJECT . "/view/homepage.html.php");
        break;

    // ── Traitement du formulaire d'ajout ─────────────────────────────────────
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $fullName = trim($_POST['full_name'] ?? '');
            $title = trim($_POST['title'] ?? '');
            $textComment = trim($_POST['text_comment'] ?? '');

            if ($email && $fullName && $title && $textComment) {
                addCommentaire($pdo, $email, $fullName, $title, $textComment);
            }
        }
        // Redirection vers l'accueil pour éviter la re-soumission du formulaire
        header("Location: index.php?action=home");
        exit;
}
