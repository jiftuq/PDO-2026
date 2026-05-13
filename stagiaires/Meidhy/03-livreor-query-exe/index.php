<?php

// chargement de nos constantes de connexion
require_once 'config-dev.php';

// tentative de connexion
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// on vérifie si on a envoyé le formulaire  
if(isset($_POST['email_message'],$_POST['texte_message'])){
    // on va créer des variables de traitement :
    // retourne le mail (string) si valide via expression régulière sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL); 
    
    // on retire les balises html pour sécuriser la chaine (! très sécure) seulement si on ne permets aucune balises 
    // htmlspecialchars est hautement recommandée
    $text = strip_tags($_POST['texte_message']); 

    // on retire les espaces vides devant et derrière la chaine 
    $text = trim($text); 

    // on convertit les cara spéciaux dangereux pour injection SQL et/ou XSS en entité HTML 
    $text = htmlspecialchars($text); 

    // si le mail ne vaut pas false ou (non exclusif) que le texte n'est pas vide 
    if($email!==false && $text!==""){
        // preparation de la requete pour s'habituer
        $sql = "INSERT INTO `message` (`email_message`,`texte_message`)
        VALUES ('$email','$text');";

        // exécution de l'insertion qui contiendra le nombre de ligne afféctées par la requete 
        $nb_affected_line = $connectDB->exec($sql); 

        //si au moins une ligne est affectée 
        if($nb_affected_line)
            $thanks = "Merci pour l'ajout"; 
    } 
    // var_dump($email, $text);
}

// on récupère les messages
$request = $connectDB->query("SELECT * FROM `message`");

// on compte le nombre de message(s) affecté(s) ici récupéré(s)
$nbMessage = $request->rowCount();

// si pas de message
if($nbMessage===0){
    $message ="Pas encore de message";

// on a au moins 1 message, mais probablement plus    
}else{
    // on va récupérer les résultats dans un format gérable par PHP
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
}

$request->closeCursor();

$connectDB = null;

// var_dump($connectDB,$request,$nbMessage,$message,$results);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or — Événement ABC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@300;400;500&family=Instrument+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #09090e;
            --surface:    #0e0e15;
            --surface2:   #13131c;
            --border:     rgba(255,255,255,0.06);
            --text:       #ede8df;
            --muted:      #6b665f;
            --muted2:     #9c9590;
            --accent:     #c8f060;
            --accent-dim: rgba(200,240,96,0.10);
            --red:        #f06060;
            --font-display: 'Bebas Neue', sans-serif;
            --font-serif:   'DM Serif Display', serif;
            --font-mono:    'DM Mono', monospace;
            --font-body:    'Instrument Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 16px;
            line-height: 1.6;
            cursor: none;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NOISE ── */
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 9990; pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='.035'/%3E%3C/svg%3E");
            opacity: .55;
        }

        /* ── CURSOR ── */
        #cur {
            width: 10px; height: 10px;
            background: var(--accent);
            border-radius: 50%;
            position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 9999;
            transform: translate(-50%,-50%);
            mix-blend-mode: difference;
            transition: width .25s, height .25s;
        }
        #cur-ring {
            width: 38px; height: 38px;
            border: 1px solid rgba(200,240,96,.35);
            border-radius: 50%;
            position: fixed; top: 0; left: 0;
            pointer-events: none; z-index: 9998;
            transform: translate(-50%,-50%);
            transition: all .4s cubic-bezier(.25,.46,.45,.94);
        }
        body:has(a:hover, button:hover, input:hover, textarea:hover) #cur { width: 22px; height: 22px; }
        body:has(a:hover, button:hover, input:hover, textarea:hover) #cur-ring { width: 60px; height: 60px; border-color: rgba(200,240,96,.15); }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 500;
            padding: 1.6rem 3.5rem;
            display: flex; justify-content: space-between; align-items: center;
            transition: all .5s;
        }
        nav.scrolled {
            padding: 1rem 3.5rem;
            background: rgba(9,9,14,.85);
            backdrop-filter: blur(24px) saturate(1.4);
            border-bottom: 1px solid var(--border);
        }
        .nav-logo {
            font-family: var(--font-display);
            font-size: 1.5rem; letter-spacing: .18em;
            color: var(--accent); text-decoration: none;
        }
        .nav-links { display: flex; gap: 3rem; }
        .nav-links a {
            font-family: var(--font-mono);
            font-size: .72rem; letter-spacing: .18em; text-transform: uppercase;
            color: var(--muted); text-decoration: none;
            transition: color .2s; position: relative;
        }
        .nav-links a::before {
            content: attr(data-n);
            position: absolute; top: -9px; left: 0;
            font-size: .52rem; color: var(--accent); opacity: .55;
        }
        .nav-links a:hover { color: var(--text); }
        .nav-cta {
            font-family: var(--font-mono);
            font-size: .72rem; letter-spacing: .14em; text-transform: uppercase;
            padding: .55rem 1.4rem;
            border: 1px solid rgba(200,240,96,.3);
            color: var(--accent); text-decoration: none; border-radius: 2px;
            transition: all .25s;
        }
        .nav-cta:hover { background: var(--accent); color: var(--bg); }

        /* ── MAIN ── */
        main {
            flex: 1;
            padding: 11rem 3.5rem 6rem;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── EYEBROW ── */
        .label {
            font-family: var(--font-mono); font-size: .68rem;
            letter-spacing: .24em; text-transform: uppercase; color: var(--accent);
            display: flex; align-items: center; gap: .8rem; margin-bottom: 1.2rem;
            opacity: 0; animation: fu .5s .2s forwards;
        }
        .label-n { font-size: .6rem; color: rgba(200,240,96,.4); }

        .page-title {
            font-family: var(--font-serif);
            font-size: clamp(3rem, 7vw, 5.5rem);
            line-height: 1.05; margin-bottom: 1rem;
            opacity: 0; animation: fu .7s .35s forwards;
        }
        .page-title em { font-style: italic; color: var(--accent); }

        .page-intro {
            font-size: .95rem; color: var(--muted2); line-height: 1.8;
            max-width: 520px;
            border-left: 1px solid rgba(200,240,96,.2);
            padding-left: 1.5rem;
            margin-bottom: 4rem;
            opacity: 0; animation: fu .6s .5s forwards;
        }

        @keyframes fu { to { opacity: 1; transform: translateY(0); } }
        .label, .page-title, .page-intro { transform: translateY(20px); }

        /* ── THANKS BANNER ── */
        .thanks-banner {
            background: var(--accent-dim);
            border: 1px solid rgba(200,240,96,.25);
            border-radius: 2px;
            padding: 1.4rem 2rem;
            display: flex; align-items: center; gap: 1rem;
            margin-bottom: 3rem;
            opacity: 0; animation: fu .5s .1s forwards; transform: translateY(10px);
        }
        .thanks-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--accent); flex-shrink: 0;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(200,240,96,.4); }
            50%       { box-shadow: 0 0 0 5px rgba(200,240,96,0); }
        }
        .thanks-text {
            font-family: var(--font-mono); font-size: .78rem;
            letter-spacing: .1em; color: var(--accent);
        }
        .thanks-sub {
            font-size: .75rem; color: var(--muted);
            font-family: var(--font-mono); letter-spacing: .06em;
            margin-top: .15rem;
        }

        /* ── FORM ── */
        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 2px;
            padding: 2.5rem;
            margin-bottom: 5rem;
            position: relative; overflow: hidden;
            opacity: 0; animation: fu .6s .55s forwards; transform: translateY(20px);
        }
        .form-card::before {
            content: '';
            position: absolute; top: -1px; left: 10%; width: 80%; height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: .35;
        }
        .form-title {
            font-family: var(--font-display);
            font-size: 1.4rem; letter-spacing: .18em;
            color: var(--text); margin-bottom: 2rem;
            display: flex; align-items: center; gap: 1rem;
        }
        .form-title::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }

        .field { margin-bottom: 1.4rem; }
        .field label {
            display: block;
            font-family: var(--font-mono); font-size: .65rem;
            letter-spacing: .2em; text-transform: uppercase;
            color: var(--muted); margin-bottom: .6rem;
        }
        .field input,
        .field textarea {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 2px;
            color: var(--text);
            font-family: var(--font-body); font-size: .92rem;
            padding: .85rem 1.1rem;
            transition: border-color .2s, background .2s;
            outline: none;
            cursor: none;
            resize: none;
        }
        .field input::placeholder,
        .field textarea::placeholder { color: var(--muted); }
        .field input:focus,
        .field textarea:focus {
            border-color: rgba(200,240,96,.4);
            background: #0f0f18;
        }
        .field textarea { height: 120px; line-height: 1.65; }

        .btn-submit {
            display: inline-flex; align-items: center; gap: .75rem;
            font-family: var(--font-mono); font-size: .72rem;
            letter-spacing: .14em; text-transform: uppercase;
            padding: .75rem 2rem;
            background: var(--accent); color: var(--bg); font-weight: 600;
            border: none; border-radius: 2px;
            cursor: none; transition: all .2s;
        }
        .btn-submit:hover { background: #d4f570; transform: translateY(-1px); }
        .btn-submit:active { transform: scale(.97); }
        .btn-submit svg { width: 14px; height: 14px; }

        /* ── SEPARATOR ── */
        .section-sep {
            display: flex; align-items: center; gap: 1.5rem;
            margin-bottom: 3rem;
            opacity: 0; animation: fu .5s .7s forwards; transform: translateY(10px);
        }
        .section-sep .sep-label {
            font-family: var(--font-display); font-size: 1.3rem;
            letter-spacing: .18em; color: var(--text); white-space: nowrap;
        }
        .section-sep .sep-count {
            font-family: var(--font-mono); font-size: .68rem;
            letter-spacing: .14em; color: var(--accent);
            padding: .2rem .7rem; border: 1px solid rgba(200,240,96,.25);
            border-radius: 2px;
        }
        .section-sep::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        /* ── NO MESSAGES ── */
        .no-messages {
            text-align: center; padding: 4rem 2rem;
            background: var(--surface);
            border: 1px dashed var(--border); border-radius: 2px;
        }
        .no-messages-icon {
            font-size: 2.5rem; margin-bottom: 1rem; opacity: .4;
        }
        .no-messages p {
            font-family: var(--font-mono); font-size: .72rem;
            letter-spacing: .12em; color: var(--muted); text-transform: uppercase;
        }

        /* ── MESSAGE CARDS ── */
        .messages-list {
            display: flex; flex-direction: column; gap: 1px;
        }
        .reponse {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 2px; padding: 1.8rem 2rem;
            transition: border-color .3s, background .3s;
            position: relative;
            opacity: 0;
            animation: fu .5s forwards;
        }
        .reponse:hover {
            border-color: rgba(200,240,96,.15);
            background: var(--surface2);
        }
        .reponse-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1rem; flex-wrap: wrap; gap: .5rem;
        }
        .reponse-author {
            display: flex; align-items: center; gap: .75rem;
        }
        .reponse-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--accent-dim);
            border: 1px solid rgba(200,240,96,.2);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: .85rem;
            color: var(--accent); flex-shrink: 0;
        }
        .reponse-email {
            font-family: var(--font-mono); font-size: .72rem;
            letter-spacing: .06em; color: var(--text);
        }
        .reponse-date {
            font-family: var(--font-mono); font-size: .62rem;
            letter-spacing: .1em; color: var(--muted);
            padding: .2rem .7rem;
            border: 1px solid var(--border); border-radius: 2px;
        }
        .reponse-body {
            font-size: .92rem; color: var(--muted2); line-height: 1.75;
            padding-left: calc(32px + .75rem);
        }
        .reponse-accent {
            position: absolute; left: 0; top: 0; bottom: 0;
            width: 2px; background: transparent;
            transition: background .3s;
        }
        .reponse:hover .reponse-accent { background: var(--accent); opacity: .4; }

        /* ── FOOTER ── */
        footer {
            padding: 2rem 3.5rem; border-top: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
            margin-top: auto;
        }
        footer .f-left { display: flex; align-items: center; gap: 2rem; }
        .f-logo { font-family: var(--font-display); font-size: 1.2rem; letter-spacing: .18em; color: var(--accent); }
        .f-copy { font-family: var(--font-mono); font-size: .65rem; letter-spacing: .1em; color: #a8a39c; }
        .f-right { display: flex; gap: 2rem; }
        .f-right a {
            font-family: var(--font-mono); font-size: .65rem; letter-spacing: .12em;
            text-transform: uppercase; color: #a8a39c; text-decoration: none; transition: color .2s;
        }
        .f-right a:hover { color: var(--text); }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            nav { padding: 1.2rem 1.5rem; }
            .nav-links, .nav-cta { display: none; }
            main { padding: 9rem 1.5rem 4rem; }
            footer { flex-direction: column; gap: 1.2rem; text-align: center; }
            footer .f-left { flex-direction: column; gap: .5rem; }
            .form-card { padding: 1.8rem 1.4rem; }
            .reponse-body { padding-left: 0; margin-top: .75rem; }
        }

        @media (hover: none), (pointer: coarse) {
            body { cursor: auto !important; }
            #cur, #cur-ring { display: none !important; }
            .btn-submit, input, textarea { cursor: auto; }
        }
    </style>
</head>
<body>

    <div id="cur"></div>
    <div id="cur-ring"></div>

    <nav id="nav">
        <a href="index.html" class="nav-logo">TANUKI</a>
        <div class="nav-links">
            <a href="about.html"    data-n="01">À propos</a>
            <a href="projects.html" data-n="02">Projets</a>
            <a href="skills.html"   data-n="03">Skills</a>
            <a href="contact.html"  data-n="04">Contact</a>
        </div>
        <a href="mailto:thecurioustanuki@gmail.com" class="nav-cta">Disponible →</a>
    </nav>

    <main>

        <div class="label"><span class="label-n">06 /</span> Livre d'or</div>
        <h1 class="page-title">Événement<em> ABC</em></h1>
        <p class="page-intro">Merci de nous laisser un message sur l'événement ABC. Vos retours sont précieux.</p>

        <?php if (isset($thanks)): ?>

            <div class="thanks-banner">
                <div class="thanks-dot"></div>
                <div>
                    <div class="thanks-text"><?= htmlspecialchars($thanks) ?></div>
                    <div class="thanks-sub">Redirection dans 3 secondes…</div>
                </div>
            </div>
            <script>
                setTimeout(() => { window.location.href = "./"; }, 3000);
            </script>

        <?php else: ?>

            <!-- FORM -->
            <div class="form-card">
                <div class="form-title">Laisser un message</div>
                <form action="" method="POST" name="Message" autocomplete="off">
                    <div class="field">
                        <label for="email_message">Votre adresse e-mail</label>
                        <input type="email" id="email_message" name="email_message" placeholder="vous@exemple.com" required>
                    </div>
                    <div class="field">
                        <label for="texte_message">Votre message</label>
                        <textarea id="texte_message" name="texte_message" placeholder="Partagez votre expérience…" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        Envoyer
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- MESSAGES -->
            <?php if (isset($message)): ?>

                <div class="no-messages">
                    <div class="no-messages-icon">✉️</div>
                    <p><?= htmlspecialchars($message) ?></p>
                </div>

            <?php else: ?>

                <div class="section-sep">
                    <span class="sep-label">Messages</span>
                    <?php $pluriel = $nbMessage > 1 ? "s" : ""; ?>
                    <span class="sep-count"><?= $nbMessage ?> message<?= $pluriel ?></span>
                </div>

                <div class="messages-list">
                    <?php foreach ($results as $i => $result): ?>
                    <div class="reponse" style="animation-delay: <?= $i * 0.08 ?>s">
                        <div class="reponse-accent"></div>
                        <div class="reponse-header">
                            <div class="reponse-author">
                                <div class="reponse-avatar">
                                    <?= strtoupper(substr($result['email_message'], 0, 1)) ?>
                                </div>
                                <span class="reponse-email"><?= htmlspecialchars($result['email_message']) ?></span>
                            </div>
                            <span class="reponse-date"><?= htmlspecialchars($result['date_message']) ?></span>
                        </div>
                        <div class="reponse-body">
                            <?= nl2br(htmlspecialchars($result['texte_message'])) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

        <?php endif; ?>

    </main>

    <footer>
        <div class="f-left">
            <span class="f-logo">LASS</span>
            <span class="f-copy">© 2025 · Tous droits réservés</span>
        </div>
        <div class="f-right">
            <a href="about.html">À propos</a>
            <a href="projects.html">Projets</a>
            <a href="skills.html">Skills</a>
            <a href="contact.html">Contact</a>
        </div>
    </footer>

    <script>
        /* Cursor */
        const cur  = document.getElementById('cur');
        const ring = document.getElementById('cur-ring');
        let mx = 0, my = 0, rx = 0, ry = 0;
        document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
        (function loop() {
            rx += (mx - rx) * .18;
            ry += (my - ry) * .18;
            cur.style.left  = mx + 'px';
            cur.style.top   = my + 'px';
            ring.style.left = rx + 'px';
            ring.style.top  = ry + 'px';
            requestAnimationFrame(loop);
        })();

        /* Nav scroll */
        const nav = document.getElementById('nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 40);
        });
    </script>
</body>
</html>