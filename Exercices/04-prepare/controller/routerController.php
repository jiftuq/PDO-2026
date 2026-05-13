<?php
# Router, qui agit suivant les actions de l'utilisateur

# Appel de dépendances
require ROOT_PROJECT."/model/LivreModel.php";

// si l'utilisateur a envoyé le formulaire // noms valides
if(isset($_POST['email'],$_POST['title'],$_POST['text'])){
    // on reçoit true en cas de réussite, false en cas d'échec
    $insert = insertLivre($db, $_POST);
}

// on prend les messages
$livres = readLivres($db);

// Appel de la vue
include ROOT_PROJECT."/view/homepage.view.php";