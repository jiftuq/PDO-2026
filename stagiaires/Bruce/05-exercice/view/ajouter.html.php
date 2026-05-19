<?php $pageTitle = 'Ajouter un commentaire'; ?>
<?php require __DIR__ . '/_header.html.php'; ?>

<h1>Ajouter un commentaire</h1>

<form action="index.php?page=ajouter" method="post" id="commentForm" novalidate>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
               required maxlength="120">
        <?php if (!empty($errors['email'])): ?>
            <p class="error"><?= $errors['email'] ?></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="full_name">Nom complet *</label>
        <input type="text" name="full_name" id="full_name"
               value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>"
               required minlength="5" maxlength="120">
        <?php if (!empty($errors['full_name'])): ?>
            <p class="error"><?= $errors['full_name'] ?></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="title">Titre *</label>
        <input type="text" name="title" id="title"
               value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
               required minlength="5" maxlength="180">
        <?php if (!empty($errors['title'])): ?>
            <p class="error"><?= $errors['title'] ?></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="text_comment">Commentaire *</label>
        <textarea name="text_comment" id="text_comment"
                  rows="6" required minlength="5" maxlength="1000"><?= htmlspecialchars($_POST['text_comment'] ?? '') ?></textarea>
        <?php if (!empty($errors['text_comment'])): ?>
            <p class="error"><?= $errors['text_comment'] ?></p>
        <?php endif; ?>
    </div>

    <button type="submit">Envoyer</button>

</form>

<?php require __DIR__ . '/_footer.html.php'; ?>
