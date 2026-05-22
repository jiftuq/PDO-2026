<?php
// 05-exercice/controller/routerController.php

# Importer le fichier model qui contient nos fonctions de la table commentaire
require ROOT_PROJECT."/model/CommentaireModel.php";

# Création de notre connexion PDO (avec try catch)
// tentative de connexion
try{
    $connectDB = new PDO(
        dsn:MARIA_DSN, 
        username:DB_CONNECT_USER, 
        password:DB_CONNECT_PWD,
        // tableau de paramètres de connexion, ici pour recevoir les
        // résultats des query en tableau associatif
        // ! seul endroit où on peut créer une connexion permanante
        options:[
        // connexion permanante seulement ici, pas avec setAttribute()
        // PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

    // modification de la connexion en dehors de celle-ci (pour la gestion d'erreurs, valeur par défaut de PDO depuis PHP 8.0)
    $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(Exception $e){
    // arrêt et affichage de l'erreur (en dev)
    die($e->getMessage());
}

// si $_GET['section'] n'existe pas on donne la valeur homepage 
$section = $_GET['section'] ?? 'homepage';

# Page d'accueil
if($section==='homepage'){

    # si nous sommes sur l'accueil
    include ROOT_PROJECT."/view/homepage.html.php";

# Page de commentaires
}elseif($section==='commentaires'){
    # chargement des commentaires
    $commentaires = readCommentaires($connectDB);
    # on compte les commentaires
    $nbCommentaires = count($commentaires);
    # Partie commentaires
    include ROOT_PROJECT."/view/commentaires.html.php";

# Page de formulaire
}elseif($section==='ajouter'){
     include ROOT_PROJECT."/view/ajouter.html.php";

# Sinon erreur 404 
}else{
    include ROOT_PROJECT."/view/page404.html.php";
}

// bonne pratique, fermeture de connexion
$connectDB = null;
