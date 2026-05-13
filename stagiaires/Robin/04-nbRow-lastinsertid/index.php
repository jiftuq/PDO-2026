<?php

// Chargement de nos constantes de connexion
require_once 'config-dev.php';

// Tentative de connexion
try{
    $connectDB = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD);
}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// On vérifie si on a envoyé le formulaire
if(isset($_POST['email_message'],$_POST['texte_message'])){

    // On va Créer des variables de traitement :

    # Retourne le mail (string) si valide via expression régulière, sinon false (bool)
    $email = filter_var($_POST['email_message'], FILTER_VALIDATE_EMAIL);

    # On retire les balise html pour sécuriser la chaîne attention (! très sécure seulement
    # si on ne permet aucune balise, l'htmlspecialchars est hautement recommandé)
    $text = strip_tags($_POST['texte_message']);

    # On retire les espaces vides devant et derrière la chaîne
    $text = trim($text);

    # On convertit les caractères spéciaux dangereux pour injection SQL et/ou XSS
    # en entité html
    $text = htmlspecialchars($text);

    #echo nl2br($text);

    #var_dump($email,$text);

    // Si le mail ne vaut pas false ET que le texte n'est pas vide
    if ($email!==false &&  $text!==""){
        // préparation de la requète (pour s'habituer ;-)
        $sql = "INSERT INTO `message` (`email_message`,`texte_message`)
        VALUE ('$email','$text'), ('$email','$text');";
        // Execution de l'insertion qui contiendra le nombre
        // de ligne affectées pas la requête
        $nb_affected_line = $connectDB->exec($sql);

        // on veut récupérer le dernier id insérer (par vous sur 1 insertion)
        $last_insert_id = $connectDB->lastInsertId();

        // si au moins une ligne est affectée (1 == true, 0 == false)
        if($nb_affected_line)
            $thanks = "Merci pour l'ajout de l'ID $last_insert_id : $nb_affected_line ligne";

    }

}


// On récupère les messages
$request = $connectDB->query("SELECT * FROM `message` ORDER BY `date_message` DESC");

// On compte le nombre de message(s) affecté(s) ici récupéré(s)
$nbMessage = $request->rowCount();

// si pas de message
if($nbMessage === 0){
    $message = "Pas encore de message";

// On a au moins 1 message, mais probablement plus
}else{
    // on va récupérer les résultats dans un format gérable par PHP
    $results = $request->fetchALL(PDO::FETCH_ASSOC);
}

$request->closeCursor();

$connectDB = null;

// var_dump($connectDB,$request,$nbMessage,$message,$results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>Livre d'or | Evénement ABC</title>
</head>
<style>
  /* Variables — reprises du portfolio kukicha_dev */
  :root {
    --orange: #f07020;
    --green:  #44ff99;
    --bg:     #080808;
    --bg2:    #181818;
    --bdr:    #2a2a2a;
    --txt:    #f0eae2;
    --sub:    #c0b0a4;
    --muted:  #6a6058;

    --font-mono:    'Space Mono', monospace;
    --font-display: 'Bebas Neue', sans-serif;
  }

  /* Reset basique */
  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    background: var(--bg);
    color: var(--txt);
    font-family: var(--font-mono);
    font-size: 14px;
    line-height: 1.7;
    min-height: 100vh;
    padding: 3rem 1.5rem;
    overflow-x: hidden;
  }

  /* Effet scanlines retro CRT, tres subtil */
  body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: repeating-linear-gradient(
      180deg,
      transparent 0px,
      transparent 3px,
      rgba(0, 0, 0, 0.04) 3px,
      rgba(0, 0, 0, 0.04) 4px
    );
    pointer-events: none;
    z-index: 9000;
  }

  /* Container principal centre */
  body > * {
    max-width: 720px;
    margin-left: auto;
    margin-right: auto;
  }

  /* Titre principal */
  h1 {
    font-family: var(--font-display);
    font-size: clamp(2.5rem, 6vw, 4rem);
    letter-spacing: 0.04em;
    color: var(--orange);
    margin-bottom: 0.5rem;
    line-height: 1;
  }

  /* Sous-titre intro */
  body > p {
    color: var(--sub);
    font-size: 0.85rem;
    margin-bottom: 2.5rem;
    border-left: 2px solid var(--orange);
    padding-left: 0.8rem;
  }

  /* Message de remerciement apres envoi */
  body > h3 {
    background: rgba(68, 255, 153, 0.08);
    border: 1px solid rgba(68, 255, 153, 0.3);
    color: var(--green);
    padding: 0.8rem 1.2rem;
    margin-bottom: 1.5rem;
    font-size: 0.85rem;
    font-weight: 400;
    letter-spacing: 0.05em;
  }

  /* Formulaire */
  form {
    background: var(--bg2);
    border: 1px solid var(--bdr);
    padding: 1.8rem;
    margin-bottom: 3rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  /* Inputs et textarea */
  input[type="text"],
  textarea {
    background: var(--bg);
    border: 1px solid var(--bdr);
    color: var(--txt);
    font-family: var(--font-mono);
    font-size: 0.85rem;
    padding: 0.7rem 0.9rem;
    width: 100%;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  input[type="text"]::placeholder,
  textarea::placeholder {
    color: var(--muted);
  }

  input[type="text"]:focus,
  textarea:focus {
    outline: none;
    border-color: var(--orange);
    box-shadow: 0 0 0 3px rgba(240, 112, 32, 0.15);
  }

  textarea {
    min-height: 120px;
    resize: vertical;
    line-height: 1.6;
    font-family: var(--font-mono);
  }

  /* Bouton submit */
  input[type="submit"] {
    background: transparent;
    border: 1px solid var(--orange);
    color: var(--orange);
    font-family: var(--font-mono);
    font-size: 0.7rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.8rem 1.5rem;
    cursor: pointer;
    align-self: flex-start;
    transition: background 0.2s, color 0.2s;
  }

  input[type="submit"]:hover {
    background: var(--orange);
    color: var(--bg);
  }

  /* Compteur de messages */
  body > div > h3 {
    font-family: var(--font-mono);
    font-size: 0.75rem;
    color: var(--muted);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
    padding-bottom: 0.6rem;
    border-bottom: 1px solid var(--bdr);
  }

  /* Liste des messages */
  .reponse {
    background: var(--bg2);
    border: 1px solid var(--bdr);
    border-left: 2px solid var(--orange);
    padding: 1.2rem 1.5rem;
    margin-bottom: 1rem;
    transition: border-left-color 0.2s, transform 0.2s;
  }

  .reponse:hover {
    border-left-color: var(--green);
    transform: translateX(3px);
  }

  /* Header de chaque message (id, email, date) */
  .reponse h5 {
    font-size: 0.65rem;
    color: var(--muted);
    letter-spacing: 0.05em;
    font-weight: 400;
    margin-bottom: 0.6rem;
    text-transform: lowercase;
  }

  /* Le hr inutile dans .reponse, on le cache */
  .reponse hr {
    display: none;
  }

  /* Texte du message */
  .reponse p {
    color: var(--sub);
    font-size: 0.85rem;
    line-height: 1.8;
  }

  /* Mobile */
  @media (max-width: 600px) {
    body {
      padding: 2rem 1rem;
    }

    form {
      padding: 1.2rem;
    }
  }
</style>
<body>
    <h1>Livre d'or</h1>
    <p>Merci de me laisser un message sur l'événement ABC</p>
    <?php
    if(isset($thanks)):
    ?>
    <h3><?=$thanks?></h3>
    <script>
        setTimeout(() => {
            window.location.href="./";
        }
            , "3000");
    </script>
    <?php
    endif;
    ?>
    <form action="" method="POST" name='Message'>
        <input type="text" name="email_message" placeholder="Votre mail" /><br>
        <textarea name="texte_message" placeholder="Votre message"></textarea><br>
        <input type="submit" value="Envoyer">
        <?php
        // var_dump($_POST);
        ?>
    </form>
    <div>
    <?php
    // Pas de messages postés
    if(isset($message)):
    ?>
    <h3><?= $message ?></h3>
    <?php
    // On a au moins un message dans la table
    else:
        // Pour le pluriel
        $pluriel = $nbMessage > 1 ? "s" : "";
    ?>
    <h3>Nous avons <?= $nbMessage ?> message<?=$pluriel?></h3>
    <?php
        // Tant qu'on a des messages
        foreach($results as $result):
    ?>
    <div class="reponse">
        <h5>ID : <?=  $result['id_message'] ?> | <?= $result['email_message'] ?> a écrit à <?= $result['date_message'] ?></h5>
        <p><?= nl2br($result['texte_message']); // retour automatique à la ligne ?></p>
        <hr>
    </div>
    <?php
        endforeach;
    endif;
    ?>
    </div>
</body>
</html>