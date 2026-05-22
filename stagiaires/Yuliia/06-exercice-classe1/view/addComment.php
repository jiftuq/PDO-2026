<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="css/styles.css">
    <title>NW - <?= ucfirst($_GET['p']) ?></title>
</head>

<body>
<header>
<nav class="nav">
        <?php
        include ROOT_PROJECT . "/view/inc/header.php";
        ?>
</nav>
    <nav class="nav_mobile">
    
        <?php
        include ROOT_PROJECT . "/view/inc/header_mobile.php";
        ?>
        
    </nav>
    <ul class="nav_mobile_list">
        <li class="nav_mobile_item"><a class="nav_mobile_link" href="./">Accueil</a></li>
        <li class="nav_mobile_item"><a class="nav_mobile_link" href="?p=addComment">Ajoutre un commentaire</a></li>
        <li class="nav_mobile_item"><a class="nav_mobile_link" href="?p=comments">Commentaires</a></li>
    </ul>
</header>
   
    <div class="section_wrapper">
    <h2>Ajoutez un commentaire</h2>
    <form class="form" action="" method="POST" >
    <label for="email">Votre mail</label>
        <input type="email" id="email" name="email" placeholder="email@gmail.com" autocomplete="email">
        <label for="full_name">Prenom</label>
        <input type="text" id="full_name" name="full_name" placeholder="Michel Michel">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" placeholder="title">
        <label for="text_comment">Message</label>
        <textarea id="text_comment" name="text_comment" rows="4" placeholder="Ce que vous avez pensé de votre visite..."></textarea>
        <button type="submit" class="submit-btn">Ajouter</button>
    </form>
    </div>
  <script src="js/script.js"></script>
</body>

</html>