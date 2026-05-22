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
<div>
    <section class="section_wrapper">
        <section class="comments_section"> 
    <?php
            
            $nbComment = $countComments;
            if (empty($nbComment)):
            ?>
                <h2>Il n'y a pas encore de messages</h2>
            <?php
            // il y a au mois un message
            else:
                // preparation du pluriel si on a plus d'un message
                $pluriel = $nbComment > 1 ? "s" : "";
            
            // affichage de la pagination    
            echo $pagination; 
            ?>
            
</section>
                <section class="comments_section">
                    <h2>Message<?= $pluriel ?> récent<?= $pluriel ?> (<?= $nbComment ?>)</h2>
                    <?php
                    foreach ($comments as $comment):
                    ?>
                        <div class="comments_card">
    <div class="comment_avatar">
        <?= strtoupper(substr($comment['email'], 0, 2)) ?>
    </div>
    <div class="comment_body">
        <div class="comment_meta">
            <span class="write_by"><?= htmlspecialchars($comment['email']) ?></span>
            <span class="comment_date"><?= $comment['post_date'] ?></span>
        </div>
        <p><?= nl2br(htmlspecialchars($comment['text_comment'])) ?></p>
    </div>
</div>
                <?php
                    endforeach;
                    // affichage de la pagination    
                    echo $pagination; 
                endif;
                ?>
</div>        </section>
</section>
<script src="js/script.js"></script>
</body>

</html>