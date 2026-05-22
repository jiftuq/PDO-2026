<?php
// stagiaires/Michael/06-exercice-classe1/controller/routerController.php

# Importer le fichier model
require ROOT_PROJECT."/model/CommentaireModel.php";

# Connexion PDO
try {
    $connectDB = new PDO(MARIA_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
    $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die($e->getMessage());
}

# Variables par défaut (évite les "Undefined variable")
$nb_commentaires = 0;
$commentaires    = [];
$errors          = [];
$old             = [];
$flash_success   = "";
$page_courante   = 1;
$total_pages     = 1;

# Routing selon $_GET['page']
$page = $_GET['page'] ?? 'accueil';

if ($page === 'commentaires') {

    if (isset($_SESSION['flash_success'])) {
        $flash_success = $_SESSION['flash_success'];
        unset($_SESSION['flash_success']);
    }

    $nb_commentaires = countAllCommentaires($connectDB);
    $page_courante   = isset($_GET['p']) && (int)$_GET['p'] > 0 ? (int)$_GET['p'] : 1;
    $total_pages     = (int) ceil($nb_commentaires / NB_BY_PAGGE);
    $commentaires    = readPaginationCommentaires($connectDB, $page_courante, NB_BY_PAGGE);

    include ROOT_PROJECT."/view/commentaires.html.php";

} elseif ($page === 'add_commentaire') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email        = trim($_POST['email']        ?? '');
        $full_name    = trim($_POST['full_name']    ?? '');
        $title        = trim($_POST['title']        ?? '');
        $text_comment = trim($_POST['text_comment'] ?? '');

        $old = compact('email', 'full_name', 'title', 'text_comment');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
            $errors[] = "L'email n'est pas valide ou dépasse 120 caractères.";
        }
        if (mb_strlen($full_name) < 5 || mb_strlen($full_name) > 120) {
            $errors[] = "Le nom doit contenir entre 5 et 120 caractères.";
        }
        if (mb_strlen($title) < 5 || mb_strlen($title) > 180) {
            $errors[] = "Le titre doit contenir entre 5 et 180 caractères.";
        }
        if (mb_strlen($text_comment) < 5 || mb_strlen($text_comment) > 1000) {
            $errors[] = "Le commentaire doit contenir entre 5 et 1000 caractères.";
        }

        if (empty($errors)) {
            addCommentaire($connectDB, $email, $full_name, $title, $text_comment);
            $_SESSION['flash_success'] = "Merci pour votre commentaire ! 🎉";
            header('Location: index.php?page=commentaires');
            exit;
        }
    }

    include ROOT_PROJECT."/view/add_commentaire.html.php";

} else {

    $nb_commentaires = countAllCommentaires($connectDB);

    include ROOT_PROJECT."/view/homepage.html.php";

}