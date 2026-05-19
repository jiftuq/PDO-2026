<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Ajouter un commentaire</title>
</head>
<body>

    <nav>
        <div class="nav-inner">
            <a href="index.php" class="nav-logo">🎹 Ma Passion</a>

            <ul class="nav-links" id="navLinks">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?page=commentaires">Commentaires</a></li>
                <li><a href="index.php?page=add_commentaire" class="active">Ajouter un commentaire</a></li>
            </ul>

            <div style="display:flex; align-items:center; gap:0.5rem;">
                <button class="theme-toggle" id="themeToggle" title="Changer le thème">
                    <span class="icon-moon">🌙</span>
                    <span class="icon-sun">☀️</span>
                </button>
                <button class="hamburger" id="hamburger" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    <main>
        <div class="page-header" style="text-align:center;">
            <h1>Ajouter un commentaire</h1>
            <p>Partagez votre avis sur ma passion pour le piano ✨</p>
        </div>

        <div class="form-card">

            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $err): ?>
                    <div class="flash" style="background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; margin-bottom:0.6rem;">
                        ⚠️ <?= htmlspecialchars($err) ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form method="POST" action="index.php?page=add_commentaire" id="commentForm" novalidate>

                <div class="form-group">
                    <label for="email">Adresse e-mail *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        maxlength="120"
                        placeholder="exemple@mail.com"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        required
                    >
                    <span class="field-error" id="error-email">Veuillez entrer un email valide (max 120 caractères).</span>
                </div>

                <div class="form-group">
                    <label for="full_name">Nom complet *</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        minlength="5"
                        maxlength="120"
                        placeholder="Jean Dupont"
                        value="<?= htmlspecialchars($old['full_name'] ?? '') ?>"
                        required
                    >
                    <span class="field-error" id="error-full_name">Entre 5 et 120 caractères requis.</span>
                </div>

                <div class="form-group">
                    <label for="title">Titre *</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        minlength="5"
                        maxlength="180"
                        placeholder="Mon avis sur..."
                        value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                        required
                    >
                    <span class="field-error" id="error-title">Entre 5 et 180 caractères requis.</span>
                </div>

                <div class="form-group">
                    <label for="text_comment">Commentaire *</label>
                    <textarea
                        id="text_comment"
                        name="text_comment"
                        minlength="5"
                        maxlength="1000"
                        placeholder="Écrivez votre commentaire ici..."
                        required
                    ><?= htmlspecialchars($old['text_comment'] ?? '') ?></textarea>
                    <div class="char-counter" id="charCounter">1000 caractères restants</div>
                    <span class="field-error" id="error-text_comment">Entre 5 et 1000 caractères requis.</span>
                </div>

                <div style="text-align:center; margin-top:1.5rem;">
                    <button type="submit" class="btn btn-primary" style="font-size:1rem; padding:0.8rem 2.5rem;">
                        ✉️ Envoyer le commentaire
                    </button>
                </div>

            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
