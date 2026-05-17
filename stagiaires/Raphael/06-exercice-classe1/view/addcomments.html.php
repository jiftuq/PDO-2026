<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <link rel="stylesheet" href="css/global.css">
</head>
<body>

<header class="site-header">
    <h1>Ajouter un commentaire</h1>

    <nav class="nav">
        <a href="./">Accueil</a>
        <a href="?page=comments">Commentaires</a>
        <a href="?page=addcomments">Ajouter un commentaire</a>
    </nav>
</header>

<main>
    <form id="commentForm" class="form-card" method="POST" action="" novalidate>
        <h2>Votre avis sur ma passion</h2>

        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                maxlength="120"
                required
            >
            <small class="field-error" id="emailError"></small>
        </div>

        <div class="form-group">
            <label for="full_name">Nom complet</label>
            <input 
                type="text" 
                name="full_name" 
                id="full_name" 
                minlength="5"
                maxlength="120"
                required
            >
            <small class="field-error" id="fullNameError"></small>
        </div>

        <div class="form-group">
            <label for="title">Titre</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                minlength="5"
                maxlength="180"
                required
            >
            <small class="field-error" id="titleError"></small>
        </div>

        <div class="form-group">
            <label for="text_comment">Commentaire</label>
            <textarea 
                name="text_comment" 
                id="text_comment" 
                minlength="5"
                maxlength="1000"
                required
            ></textarea>
            <small class="field-error" id="textCommentError"></small>
        </div>

        <button type="submit">Envoyer le commentaire</button>
    </form>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>