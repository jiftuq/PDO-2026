<?php $pageTitle = 'Accueil'; ?>
<?php require __DIR__ . '/_header.html.php'; ?>

<h1>Bienvenue sur mon site</h1>

<p>
    Je m'appelle Bruce. Passionné de photographie, j'aime capturer des moments
    du quotidien et explorer le monde à travers mon objectif. La photo me permet
    de voir les choses différemment et de raconter des histoires sans mots.
</p>
<p>
    J’aime bien développer des sites web et créer des projets interactifs. Mon rêve est aussi de développer des jeux vidéo, créer mes propres univers et imaginer des expériences amusantes et immersives pour les joueurs.
</p>

<div class="photos">
    <img src="img/480362880_9172519729481841_4874383714243568199_n.jpg" alt="Photo 1">
    <img src="img/481308087_9208908202509660_6416295527007101672_n.jpg" alt="Photo 2">
    <img src="img/482138407_9261757177224762_1351962476718613413_n.jpg" alt="Photo 3">
</div>

<div class="page-actions">
    <a href="index.php?page=commentaires" class="btn">Voir les commentaires</a>
    <a href="index.php?page=ajouter" class="btn">Ajouter un commentaire</a>
</div>

<?php require __DIR__ . '/_footer.html.php'; ?>