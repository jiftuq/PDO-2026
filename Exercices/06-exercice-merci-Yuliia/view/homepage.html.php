<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="css/styles.css">
    <title>NW - Accueil</title>
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
<div class="hero">
    <div class="hero_wrapper">
    <h1>Connect with the <span>Natural World</span> </h1>
<p>Discover the restorative power of nature. We bridge the gap between modern living and the quiet, grounded wisdom of the Earth’s most serene landscapes. </p>
</div>
</div>
<div class="gallery">
            <div class="card">
            <div class="img_label">
            <img src="https://www.timberbush-tours.co.uk/sites/default/files/2025-06/Quiraing%20%281%29%20%282%29.jpg" alt="" >
    <span>TOP TOUR</span>  </div>
    <div class="card_body">
        <p class="card_title">The Quaring</p>
        <p class="card_desc">Embark on a true Scottish adventure with our 3-day tour small group tour to Skye from Edinburgh. Journey through the magnificent Scottish Highlands, before arriving on the mystical Isle of Skye. Enjoy a full day exploring the island's most beautiful spots, before travelling back down to Edinburgh via the most photographed castle in Scotland, Eilean Donan.</p>
    
            <a class="add_comment_link" href="?p=addComment">Ajouter</a>
        
    </div>
      
        </div>
    <div class="card">
            <div class="img_label">
            <img src="https://www.timberbush-tours.co.uk/sites/default/files/2025-05/Fort%20William.jpeg" alt="">
            <span>TOP TOUR</span>  
          </div>
          <div class="card_body">
        <p class="card_title">Fort William and Ben Nevis</p>
        <p class="card_desc">Our 1-day Loch Ness day trip from Edinburgh takes in some of the most spectacular scenery Scotland has to offer. This coach tour visits beautiful Loch Ness, haunting Glencoe, and has options for a relaxing boat cruise across Loch Ness.</p>
       
            <a class="add_comment_link" href="?p=addComment">Ajouter</a>
       
    </div>
        </div>
        <div class="card">
            <div class="img_label">
            <img src="https://www.timberbush-tours.co.uk/sites/default/files/2025-06/Glenfinnan%20monument%203%20-%20Christie_0.jpeg" alt="">
            <span>TOP TOUR</span>  
        </div>
        <div class="card_body">
        <p class="card_title">Glenfinnan Monument</p>
        <p class="card_desc">Experience the majesty of the Scottish Highlands on this one-day tour from Edinburgh. Travelling north, immerse yourself in haunting Glencoe, before visiting the famous Glenfinnan Viaduct.</p>
      
            <a class="add_comment_link" href="?p=addComment">Ajouter</a>
      
    </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>

