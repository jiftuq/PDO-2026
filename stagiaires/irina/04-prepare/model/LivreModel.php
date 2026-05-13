<?php
// ce fichier contiendre les functions
// pour gérer la table livre (future class en OO)


//function d'insertion
function insertLivre(PDO $con, array $data):bool{
    //$_POST['email'],$_POST['title'],$_POST['text']
    // traitement des variables $_POST en variables locales
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    //false si incorrecte, le mail en string si correcte
    // on retire tout les tags
   $title = strip_tags($_POST['title']);
   // on retire les espace avant et arriere
   $title = trim($title);
   // on encode les caracteres dangereux  en entités html
   $title = htmlspecialchars($title);

   $text = htmlspecialchars(trim(strip_tags($_POST['text'])));

   //si au moins un des champs n'est pas valide
   if($email ===false || empty($title) || empty($text)){
    // on arrete le script
    return false;
   }

   // on va préparer notre requête avec des marqueurs nommés
    //   (:nom) 
   $sql = "INSERT INTO `livre`
         (`email`,`title`,`text`)
         VALUES (:mail,:titre,:dutext);";
         // attendre des values de marqueurs
    $prepare = $con->prepare ($sql);
    // on va utiliser  le bienValue() par défaut
    $prepare->bindValue(":mail",$email);
    $prepare->bindValue(":dutext",$text);
    $prepare->bindValue(":titre",$title);
    // on va exécuter la requête
     $prepare->execute();
    // si on a bien inserer 1 ligne 
     return $prepare->rowCount() ===1 ?  true : false;


}
function readLivres(){
    return"Nos Livres";
}
