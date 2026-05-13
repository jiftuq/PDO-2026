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
        VALUES ('$email','$text'), ('$email','$text') ;";

        // exécution de l'insertion qui contiendra le nombre de ligne afféctées par la requete 
        $nb_affected_line = $connectDB->exec($sql); 

        // on veut récuperer le dernier id inserer (par vous sur 1 insertion)
        $last_insert_id = $connectDB->lastInsertID();

        //si au moins une ligne est affectée 
        if($nb_affected_line)
            $thanks = "Merci pour l'ajout de l'id $last_insert_id : $nb_affected_line ligne"; 
    } 
    // var_dump($email, $text);

    
}

// on récupère les messages
$request = $connectDB->query("SELECT * FROM `message` ORDER BY `date_message` DESC");

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
    <link rel="stylesheet" href="style.css">
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