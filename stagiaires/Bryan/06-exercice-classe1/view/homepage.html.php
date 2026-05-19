<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Passion – Le Football</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
</head>

<body>
    <!--NAVBAR-->
    <nav class="nav-bar">
        <div class="nav-logo">⚽ Foot<em>ball</em></div>
        <ul class="nav-links">
            <li>
                <a href="index.php?action=home" class="<?= ($action === 'home') ? 'active' : '' ?>">
                    <i class="ti ti-home" aria-hidden="true"></i> Accueil
                </a>
            </li>
            <li>
                <a href="index.php?action=home#commentaires" class="<?= ($action === 'home') ? 'active' : '' ?>">
                    <i class="ti ti-message" aria-hidden="true"></i> Commentaires
                </a>
            </li>
        </ul>
    </nav>
    <!-- HERO -->
    <header class="hero">
        <div class="hero-number"></div>
        <div class="hero-content">
            <p class="hero-tag">⚽ Ma passion</p>
            <h1>LE FOOT<em>BALL</em></h1>
            <p class="hero-sub">
                Plus qu'un sport – une façon de vivre, de penser, de ressentir.
                Chaque match est une histoire. Chaque but, une émotion pure.
            </p>
        </div>
    </header>

    <!-- À PROPOS -->
    <section class="about">
        <div class="about-grid">
            <div class="about-body">
                <p class="section-label">Pourquoi ce sport ?</p>
                <h2>Une passion<br>sans fin</h2>
                <p>
                    Le football est entré dans ma vie bien avant que je puisse en expliquer
                    la raison. <strong>Le bruit d'un stade plein</strong>, l'odeur de l'herbe
                    fraîchement coupée, la tension d'une dernière minute : tout ça, c'est
                    une drogue légale.
                </p>
                <p>
                    Ce que j'aime par-dessus tout, c'est la <strong>collectivité</strong>.
                    Onze individualités qui s'effacent pour ne former qu'un seul corps.
                    Un pressing coordonné, une combinaison en une touche, un centre millimétré –
                    c'est de la chorégraphie en temps réel.
                </p>
                <p>
                    Que ce soit devant un écran à 22 h ou les crampons aux pieds le dimanche
                    matin, le football me ressource. Il m'apprend la <strong>rigueur</strong>,
                    la <strong>résilience</strong> et la capacité à rebondir après une défaite.
                </p>
            </div>

            <div class="about-stats">
                <div class="stat-box">
                    <div class="num">11</div>
                    <div class="label">Joueurs, un seul but</div>
                </div>
                <div class="stat-box">
                    <div class="num">90'</div>
                    <div class="label">Minutes d'intensité</div>
                </div>
                <div class="stat-box">
                    <div class="num">∞</div>
                    <div class="label">Émotions ressenties</div>
                </div>
                <div class="stat-box">
                    <div class="num">#1</div>
                    <div class="label">Sport mondial</div>
                </div>
            </div>
        </div>
    </section>

    <!--PHOTOS-->
    <section class="photos">
        <p class="section-label">En images</p>
        <h2>Le terrain,<br>mon terrain</h2>

        <div class="photo-grid">

            <!-- Photo 1 -->
            <div class="photo-card">
                <img src="../public/img/canchas.jpeg" alt="Match de football – vue aérienne du terrain" loading="lazy">
                <div class="photo-caption">Le terrain, ma scène</div>
            </div>

            <!-- Photo 2 -->
            <div class="photo-card">
                <img src="../public/img/chicharito.webp" alt="Ballon de football" loading="lazy">
                <div class="photo-caption">Le cuir, l'objet sacré</div>
            </div>

            <!-- Photo 3 -->
            <div class="photo-card">
                <img src="../public/img/stade.jpg" alt="Supporters dans un stade" loading="lazy">
                <div class="photo-caption">Le stade, la famille</div>
            </div>

        </div>
    </section>

    <!--COMMENTAIRES-->
    <section id="commentaires">
        <p class="section-label">Communauté</p>
        <h2>Vos réactions</h2>

        <div class="comments-grid">

            <!-- ── Formulaire ── -->
            <form action="index.php?action=add" method="POST" autocomplete="on">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="ton@email.com"
                        autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="full_name">Nom complet</label>
                    <input type="text" id="full_name" name="full_name" required placeholder="Prénom Nom"
                        autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" required placeholder="Titre du commentaire"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="text_comment">Commentaire</label>
                    <textarea id="text_comment" name="text_comment" required placeholder="Partage ta passion..."
                        autocomplete="off"></textarea>
                </div>
                <button class="btn" type="submit">Publier →</button>
            </form>

            <!-- ── Liste des commentaires ── -->
            <div>
                <?php if (!empty($commentaires)): ?>
                    <ul class="comment-list">
                        <?php foreach ($commentaires as $c): ?>
                            <li class="comment-item">
                                <div class="comment-meta">
                                    <span class="comment-author">
                                        <?= htmlspecialchars($c['full_name']) ?>
                                    </span>
                                    <span class="comment-date">
                                        <?= date('d/m/Y à H:i', strtotime($c['post_date'])) ?>
                                    </span>
                                </div>
                                <div class="comment-title">
                                    <?= htmlspecialchars($c['title']) ?>
                                </div>
                                <p class="comment-text">
                                    <?= nl2br(htmlspecialchars($c['text_comment'])) ?>
                                </p>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <nav class="pagination" aria-label="Pages des commentaires">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="index.php?action=home&page=<?= $i ?>" class="<?= ($i === $page) ? 'active' : '' ?>"
                                    aria-current="<?= ($i === $page) ? 'page' : 'false' ?>"><?= $i ?></a>
                            <?php endfor; ?>
                        </nav>
                    <?php endif; ?>

                <?php else: ?>
                    <p class="no-comment">Aucun commentaire pour l'instant. Sois le premier !</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>Bryan Benois &mdash; <?= date('Y') ?></p>
    </footer>

</body>

</html>