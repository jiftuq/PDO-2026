<?php
// ============================================================
// ROUTER : gère les actions de l'utilisateur
// ============================================================

// Chargement du modèle (les fonctions)
require ROOT_PROJECT . "/model/LivreModel.php";


// ---- Traitement du formulaire ----
// Si l'utilisateur a soumis le formulaire, on insère le commentaire
if (isset($_POST['email'], $_POST['title'], $_POST['text'])) {
    $insert = insertLivre($db, $_POST);
}


// ============================================================
// PAGINATION
// ============================================================

// Nombre de commentaires affichés par page
$par_page = 5;

// On regarde si un numéro de page est passé dans l'URL (?page=2)
// Si oui on l'utilise, sinon on est sur la page 1
if (isset($_GET['page'])) {
    $page_actuelle = (int) $_GET['page']; // (int) convertit en nombre entier
} else {
    $page_actuelle = 1;
}

// Sécurité : la page ne peut pas être inférieure à 1
if ($page_actuelle < 1) {
    $page_actuelle = 1;
}

// On compte le nombre total de commentaires dans la base
$total_commentaires = countLivres($db);

// On calcule le nombre total de pages
// ceil() arrondit toujours vers le haut  (ex: 11/5 = 2.2 → 3 pages)
$nb_pages = (int) ceil($total_commentaires / $par_page);

// Sécurité : la page actuelle ne peut pas dépasser le nombre de pages
if ($nb_pages > 0 && $page_actuelle > $nb_pages) {
    $page_actuelle = $nb_pages;
}

// On calcule à partir de quel commentaire on commence (l'offset)
// Page 1 → offset = 0  (on commence au 1er commentaire)
// Page 2 → offset = 5  (on saute les 5 premiers)
// Page 3 → offset = 10 (on saute les 10 premiers)
$debut = ($page_actuelle - 1) * $par_page;

// On récupère uniquement les commentaires de la page actuelle
$livres = readLivres($db, $par_page, $debut);


// Appel de la vue (affichage de la page)
include ROOT_PROJECT . "/view/homepage.view.php";
