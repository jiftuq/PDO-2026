<?php
# Router, qui agit suivant les actions de l'utilisateur

# Appel de dépendances
require ROOT_PROJECT."/model/LivreModel.php";

// si l'utilisateur a envoyé le formulaire
if(isset($_POST['email'],$_POST['title'],$_POST['text'])){
    echo insertLivre();
}

$livres = readLivres();

// Appel de la vue
include ROOT_PROJECT."/view/homepage.view.php";