<?php
#Router, qui agit suivant les actions de l'utilisateur

#Appel de dépendance
require ROOT_PROJECT."/model/LivreModel.php";


// si l'utilisateur a envoyé le formulzire // nos valides
if(isset($_POST["email"],$_POST["title"],$_POST ["text"])) {
    //on recoit true en cas de réussite, false en cas d'echec
    echo insertLivre($db, $_POST);

}
$message= readLivres();
// Appel de la vue
include ROOT_PROJECT."/view/homepage.view.php";

