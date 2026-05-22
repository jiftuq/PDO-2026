<?php $pageTitle = 'Ajouter un commentaire'; ?>
<?php require __DIR__ . '/_header.html.php'; ?>

<h1>Ajouter un commentaire</h1>

<form action="" method="post" id="commentForm" novalidate>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="text" name="email" id="email" value="">
    </div>

    <div class="form-group">
        <label for="full_name">Nom complet *</label>
        <input type="text" name="full_name" id="full_name" value="">
    </div>

    <div class="form-group">
        <label for="title">Titre *</label>
        <input type="text" name="title" id="title" value="">
    </div>

    <div class="form-group">
        <label for="text_comment">Commentaire *</label>
        <textarea name="text_comment" id="text_comment" rows="6"></textarea>
    </div>

    <button type="submit">Envoyer</button>
    <?php
var_dump($_POST);
    ?>
</form>

<?php require __DIR__ . '/_footer.html.php'; ?>
