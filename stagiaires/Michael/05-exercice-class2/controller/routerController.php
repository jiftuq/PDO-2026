<?php
// 05-exercice/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire
require ROOT_PROJECT."/model/CommentaireModel.php";

# Création de notre connexion PDO (avec try catch)

# suivant les actions utilisateur, appelez les vues.

include ROOT_PROJECT."/view/homepage.html.php";