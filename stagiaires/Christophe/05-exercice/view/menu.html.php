<?php
// 05-exercice/view/menu.html.php
// Menu sticky partagé entre toutes les pages
$current = $_GET['page'] ?? 'home';
?>
<nav class="menu">
    <div class="menu-brand">📖 Mon site</div>
    <button class="menu-burger" id="burger" aria-label="Menu">☰</button>
    <ul class="menu-links" id="menu-links">
        <li><a href="?page=home" class="<?= $current === 'home' ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="?page=comments" class="<?= $current === 'comments' ? 'active' : '' ?>">Commentaires</a></li>
        <li><a href="?page=add" class="<?= $current === 'add' ? 'active' : '' ?>">Ajouter un commentaire</a></li>
    </ul>
</nav>
