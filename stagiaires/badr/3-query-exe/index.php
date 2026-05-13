<?php
//chargement de nos const de connexion
require_once 'config-dev.php';
 
// tentative de connexion
try {
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
} catch (Exception $e) {
    // arrêt et affichage de l'erreur (ev dev)
    die($e->getMessage());
}
// on vérifie si on a envoyé le formulaire
if (isset($_POST['email_message'], $_POST['texte_message'])) {
    //on va créer de var de traitement:
    # retorne le mail si valide via expression régulière, sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL);
 
    # on retire les balises html pour sécuriser la xhaine (! très sécure seulement
    #si on ne permet aucune balise, l'htmlspecialchar est hautement recommandée )
    $text = strip_tags($_POST['texte_message']);
 
    # on retire les espaces vides devant et derrière la chaine
    $text = trim($text);
 
    # on convertit les carectères spéciaux  dangereux pour injectionSQL et/ou XSS
    # en entité($text)
 
    $text = htmlspecialchars($text);
 
    // si le mail ne vaut pas (strictement) false ET que  le texte est vide
    if ($email !== false  && $text !== "") {
 
        //preparation de la requete (pour s'habituer ;-)
        $sql = "INSERT INTO `message`(`email_message`,`texte_message`)
                VALUES ('$email' ,'$text');";
 
        // exécution de l'insertion qui contiendra le nombre de ligne affectées par la requete
        $nb_affected_line = $connectDB->exec($sql);
 
        // si au mois une ligne est affecteé (1== true 0== false)
        if ($nb_affected_line) $thanks = "Merci pour l'ajout!";
    }
}
// on récupére les messages
$request = $connectDB->query("SELECT * FROM `message`");
 
// on compte le nobre de message(s) affecté(s) ici récupéré(s)
$nbMessage = $request->rowCount();
// si pas de message
if ($nbMessage === 0) {
    $message = "Pas encore de message";
 
    // on a au moins 1 message, mais probalement plus
} else {
    // on va récupérer les résultats dans un format gérable par  PHP
    $results = $request->fetchAll(PDO::FETCH_ASSOC);
}
$request->closeCursor();
 
$connectDB = null;
 
// var_dump($connectDB,$request,$nbMessage,$message);
?>
<!DOCTYPE html>
<html lang="en">
 
<style>
    *{
    box-sizing:border-box;
    margin:0;
    padding:0;
    font-family: "Segoe UI", Arial, sans-serif;
}
 
body{
    background:#0f172a;
    color:#e5e7eb;
    min-height:100vh;
    padding:20px;
}
 
/* TITRES */
h1{
    text-align:center;
    margin-bottom:10px;
    color:#38bdf8;
}
 
p{
    text-align:center;
    margin-bottom:20px;
    color:#cbd5f5;
}
 
/* FORMULAIRE */
form{
    max-width:600px;
    margin:0 auto 30px;
    background:#020617;
    padding:25px;
    border-radius:12px;
    border:1px solid #1e293b;
}
 
form input,
form textarea{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    background:#020617;
    border:1px solid #334155;
    border-radius:8px;
    color:#e5e7eb;
}
 
form input::placeholder,
form textarea::placeholder{
    color:#94a3b8;
}
 
form input:focus,
form textarea:focus{
    outline:none;
    border-color:#38bdf8;
    box-shadow:0 0 0 2px rgba(56,189,248,.2);
}
 
form textarea{
    min-height:120px;
    resize:none;
}
 
form input[type="submit"]{
    background:#38bdf8;
    border:none;
    color:#020617;
    font-weight:bold;
    cursor:pointer;
    transition:0.2s;
}
 
form input[type="submit"]:hover{
    background:#0ea5e9;
}
 
/* MESSAGE RETOUR */
h3{
    text-align:center;
    color:#4ade80;
    margin-bottom:15px;
}
 
/* LISTE DES MESSAGES */
div{
    max-width:700px;
    margin:0 auto;
}
 
div > div.message{
    background:#020617;
    border:1px solid #1e293b;
    border-radius:10px;
    padding:15px;
    margin-bottom:15px;
}
 
div.message strong{
    color:#38bdf8;
}
 
div.message small{
    display:block;
    margin-top:6px;
    font-size:12px;
    color:#94a3b8;
}
 
/* =========================
   ANIMATIONS GLOBALES
========================= */
 
/* Animation d’arrivée de la page */
body {
    animation: fadeIn 0.8s ease-in-out;
}
 
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
 
/* =========================
   FORMULAIRE
========================= */
 
form {
    animation: slideUp 0.9s ease-out;
}
 
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
 
/* Effet focus élégant */
form input:focus,
form textarea:focus {
    animation: focusGlow 0.25s ease-in-out;
}
 
@keyframes focusGlow {
    from {
        box-shadow: 0 0 0 0 rgba(56,189,248,0.4);
    }
    to {
        box-shadow: 0 0 0 4px rgba(56,189,248,0);
    }
}
 
/* Bouton : effet clic */
form input[type="submit"]:active {
    transform: scale(0.97);
}
 
/* =========================
   MESSAGES (livre d’or)
========================= */
 
.message {
    animation: messageAppear 0.6s ease forwards;
}
 
@keyframes messageAppear {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
 
/* Hover message */
.message:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.25);
    transition: 0.3s;
}
 
/* Email animé */
.message strong {
    position: relative;
}
 
.message strong::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0;
    height: 2px;
    background: #38bdf8;
    transition: width 0.3s ease;
}
 
.message:hover strong::after {
    width: 100%;
}
 -------
 
/* RESET */
*{
    box-sizing:border-box;
    margin:0;
    padding:0;
    font-family:"Segoe UI", Arial, sans-serif;
}

/* PAGE */
body{
    background:linear-gradient(135deg,#0f172a,#020617);
    color:#e5e7eb;
    min-height:100vh;
    padding:30px 15px;
    animation: fadeIn 0.8s ease-in-out;
}

/* TITRES */
h1{
    text-align:center;
    margin-bottom:10px;
    color:#38bdf8;
    font-size:2.2rem;
}

p{
    text-align:center;
    margin-bottom:30px;
    color:#cbd5f5;
}

/* FORMULAIRE */
form{
    max-width:600px;
    margin:0 auto 40px;
    background:#020617;
    padding:30px;
    border-radius:14px;
    border:1px solid #1e293b;
    box-shadow:0 20px 40px rgba(0,0,0,.35);
    animation: slideUp 0.9s ease-out;
    
}

form input,
form textarea{
    width:100%;
    padding:14px;
    margin-bottom:18px;
    background:#020617;
    border:1px solid #334155;
    border-radius:10px;
    color:#e5e7eb;
    font-size:15px;
}

form input::placeholder,
form textarea::placeholder{
    color:#94a3b8;
}

form input:focus,
form textarea:focus{
    outline:none;
    border-color:#38bdf8;
    box-shadow:0 0 0 3px rgba(56,189,248,.25);
    animation: focusGlow .25s ease-in-out;
}

form textarea{
    min-height:140px;
    resize:none;
}

/* BOUTON */
form input[type="submit"]{
    background:linear-gradient(135deg,#38bdf8,#0ea5e9);
    border:none;
    color:#020617;
    font-weight:700;
    cursor:pointer;
    transition:transform .2s, box-shadow .2s;
}

form input[type="submit"]:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 25px rgba(14,165,233,.4);
}

form input[type="submit"]:active{
    transform:scale(.97);
}

/* MESSAGE MERCI / INFO */
h3{
    text-align:center;
    color:#4ade80;
    margin-bottom:18px;
}

/* CONTAINER DES MESSAGES */
body > div{
    max-width:800px;
    margin:0 auto;
}

/* MESSAGE INDIVIDUEL */
.reponse{
    background:#020617;
    border:1px solid #1e293b;
    border-radius:14px;
    padding:20px;
    margin-bottom:18px;
    animation: messageAppear .6s ease forwards;
    transition:transform .3s, box-shadow .3s;
}

.reponse:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 30px rgba(0,0,0,.35);
}

.reponse h5{
    color:#38bdf8;
    font-size:14px;
    margin-bottom:8px;
}

.reponse p{
    color:#e5e7eb;
    line-height:1.6;
    text-align:left;
}

/* ANIMATIONS */
@keyframes fadeIn{
    from{opacity:0;transform:translateY(10px)}
    to{opacity:1;transform:translateY(0)}
}

@keyframes slideUp{
    from{opacity:0;transform:translateY(40px)}
    to{opacity:1;transform:translateY(0)}
}

@keyframes focusGlow{
    from{box-shadow:0 0 0 0 rgba(56,189,248,.4)}
    to{box-shadow:0 0 0 5px rgba(56,189,248,0)}
}

@keyframes messageAppear{
    from{opacity:0;transform:translateY(15px)}
    to{opacity:1;transform:translateY(0)}
}
h4{
    text-align:center;
    color:#cbd5f5;
    padding: 10px;
}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
 
</head>
 
<body>
    <h1>Livre d'or | Evénement ABC</h1>
    <p>Merci de me laisser un message sur l'événement ABC</p>
    <?php
    if (isset($thanks)):
    ?>
        <h3><?= $thanks ?></h3>
        <script>
            setTimeout(() => {
                window.location.href = "./";
            }, "3000")
        </script>
    <?php
    endif
    ?>
    <form action="" method="POST" name="message">
        <input type="text" name="email_message" placeholder="Votre mail"> <br>
        <textarea name="texte_message" placeholder="Votre message"></textarea> <br>
        <input type="submit" value="Envoyer">
        <?php
        // var_dump($_POST);
        ?>
    </form>
    <div>
        <?php
        // pas de message postés
        if (isset($message)):
        ?>
            <h3>
                <?= $message ?>
            </h3>
        <?php
 
        else:
            //pour le pluriel
            $pluriel = $nbMessage > 1 ? "s" : "";
        ?>
            <h4>Nous avons <?= $nbMessage ?> message<?= $pluriel ?></h4>
            <?php
 
            foreach ($results as $result):
            ?>
 
                <div class="reponse">
                    <h5> <?= $result['email_message'] ?> a écrit à <?= $result['date_message'] ?></h5>
                    <p><?= nl2br(htmlspecialchars($result['texte_message'])); // retour automatique à la ligne
                        ?></p>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</body>
 
</html>
 