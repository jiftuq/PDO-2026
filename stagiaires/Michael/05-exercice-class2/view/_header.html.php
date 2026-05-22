<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Mon Site' ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav id="top">
    <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="nav-menu" id="navMenu">
        <li><a href="./">Accueil</a></li>
        <li><a href="./?section=commentaires">Commentaires</a></li>
        <li><a href="./?section=ajouter">Ajouter un commentaire</a></li>
    </ul>
</nav>

<main>
