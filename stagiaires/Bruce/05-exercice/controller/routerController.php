<?php
// ============================================================
// ROUTER : gère les actions de l'utilisateur
// ============================================================

// Chargement du modèle (les fonctions)
require ROOT_PROJECT . "/model/CommentaireModel.php";

// Quelle page afficher ? (accueil par défaut)
$page = $_GET['page'] ?? 'accueil';

// ---- Page : Commentaires ----
if ($page === 'commentaires') {

    $commentaires   = readCommentaires($db);
    $nbCommentaires = countCommentaires($db);
    include ROOT_PROJECT . "/view/commentaires.html.php";

// ---- Page : Ajouter un commentaire ----
} elseif ($page === 'ajouter') {

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // On récupère et on nettoie les données du formulaire
        $email        = trim($_POST['email'] ?? '');
        $full_name    = trim($_POST['full_name'] ?? '');
        $title        = trim($_POST['title'] ?? '');
        $text_comment = trim($_POST['text_comment'] ?? '');

        // Validation backend (protection XSS côté serveur)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
            $errors['email'] = 'Email invalide ou trop long (max 120 caractères)';
        }
        if (mb_strlen($full_name) < 5 || mb_strlen($full_name) > 120) {
            $errors['full_name'] = 'Nom : entre 5 et 120 caractères';
        }
        if (mb_strlen($title) < 5 || mb_strlen($title) > 180) {
            $errors['title'] = 'Titre : entre 5 et 180 caractères';
        }
        if (mb_strlen($text_comment) < 5 || mb_strlen($text_comment) > 1000) {
            $errors['text_comment'] = 'Commentaire : entre 5 et 1000 caractères';
        }

        // Pas d'erreurs → on insère et on redirige vers les commentaires
        if (empty($errors)) {
            addCommentaire($db, $email, $full_name, $title, $text_comment);
            header('Location: index.php?page=commentaires');
            exit;
        }
    }

    include ROOT_PROJECT . "/view/ajouter.html.php";

// ---- Page : Accueil (défaut) ----
} else {

    include ROOT_PROJECT . "/view/homepage.html.php";

}
