<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>

    <nav>
        <div class="nav-inner">
            <a href="index.php" class="nav-logo">🎹 Ma Passion</a>

            <ul class="nav-links" id="navLinks">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="index.php?page=commentaires">Commentaires</a></li>
                <li><a href="index.php?page=add_commentaire">Ajouter un commentaire</a></li>
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
        <section class="hero">
            <h1>Ma passion : <span>le piano</span></h1>
            <p>
                Depuis toute petite, la musique fait partie de ma vie.
                Le piano est devenu bien plus qu’un simple instrument pour moi : 
                c’est une manière de m’exprimer quand les mots ne suffisent pas. 
                Chaque note, chaque mélodie me permet de transmettre une émotion, 
                de me vider l’esprit et de ressentir les choses autrement.
            </p>
        </section>

        <div class="video-grid">
            <div class="video-card">
                <video controls preload="auto">
                    <source src="img/Elastic_Heart.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
                <p class="video-label">🎵 Elastic Heart</p>
            </div>
            <div class="video-card">
                <video controls preload="auto">
                    <source src="img/River_Flows_In_You.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
                <p class="video-label">🎵 River Flows In You</p>
            </div>
            <div class="video-card">
                <video controls preload="auto">
                    <source src="img/Tous_les_cris_les_SOS.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
                <p class="video-label">🎵 Tous les cris les SOS</p>
            </div>
        </div>

        <p style="max-width:700px; margin: 0 auto; text-align:center; color:var(--text-muted); font-size:1rem;">
            Que je joue du classique, du jazz ou simplement ce qui me vient sur le moment, 
            chaque instant passé au piano est différent. J’aime découvrir de nouvelles sonorités, 
            laisser parler mes émotions à travers les touches et surtout partager cette passion avec les autres.
        </p>

        <div style="text-align:center; margin-top:1.5rem;">
            <div class="comment-count-badge">
                💬 <strong><?= $nb_commentaires ?></strong>
                <?php if ($nb_commentaires <= 1): ?>
                    commentaire déjà posté
                <?php else: ?>
                    commentaires déjà postés
                <?php endif; ?>
            </div>
        </div>

        <div class="cta-links">
            <a href="index.php?page=commentaires" class="btn btn-primary">💬 Voir les commentaires</a>
            <a href="index.php?page=add_commentaire" class="btn btn-outline">✏️ Ajouter un commentaire</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>