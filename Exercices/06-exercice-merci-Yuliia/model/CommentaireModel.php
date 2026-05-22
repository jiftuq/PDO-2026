<?php
# stagiaires/Michael/06-exercice-classe1/model/CommentaireModel.php

// utilisez le typage si possible

function addCommentaire(PDO $db,string $email,string $text_comment,string $title,string $full_name):bool{
    $email=filter_var($email,FILTER_VALIDATE_EMAIL);
    $text_comment=htmlspecialchars(trim(strip_tags($text_comment)));
    $full_name = htmlspecialchars(trim(strip_tags($full_name)));
    $title = htmlspecialchars(trim(strip_tags($title)));
    
      if($email===false             ||
    strlen($email)>120            ||
    empty($full_name)            ||
    strlen($full_name)<5         ||
    strlen($full_name)>120        ||
    empty($title)                 ||
    strlen($title)<5              ||
    strlen($title)>180           ||
    empty($text_comment)          ||
    strlen($text_comment)<5       ||
    strlen($text_comment)>1000   
    ) return false;
 
    
    $prepare = $db->prepare("
    INSERT INTO `commentaire`(`email`,`text_comment`,`full_name`,`title`)
    VALUES(:email,:text_comment,:full_name,:title); 
    ");
    # on met nos val dans 
    $prepare->bindValue(':email',$email);
    $prepare->bindValue(':text_comment',$text_comment);
    $prepare->bindValue(':full_name',$full_name);
    $prepare->bindValue(':title',$title);

    # on exécute la requete
   $retour=$prepare->execute();
   return $retour; // true en cas de réussite, false en cas d'échec

//   var_dump($db,$mail,$message);
}

function readAllCommentaires(PDO $connect): array{
$stmt=$connect->query("SELECT * FROM `commentaire` ORDER BY `post_date` DESC");
// un tableau avec les results
$result= $stmt-> fetchAll(PDO::FETCH_ASSOC);

// Bonne pratique 
$stmt->closeCursor();
// retour du tableau
 return $result;
}


// bonus pagination

# On compte le nombre total de commentaire
function countAllCommentaires(PDO $db): int
{

        $stmt = $db->query("SELECT COUNT(*) AS count FROM commentaire");
        return (int) $stmt->fetch()['count'];
}



# Pour faire le bon select dans une pagination, récupération de commentaires
function readPaginationCommentaires(PDO $db, int $pageActu=1, int $nbPerPage=5): array
{

    // pour touver l'offset (départ)
    $offset = ($pageActu - 1) * $nbPerPage;
    $limit = $nbPerPage;

    // préparation de la requête
    $sql = "SELECT * FROM `commentaire` ORDER BY `post_date` DESC LIMIT :offset, :limit;";
    $stmt = $db->prepare($sql);
    // on passe les variables à lar requêtes, ! ils doivent passer au format integer !
    $stmt->bindValue("offset",$offset,PDO::PARAM_INT);
    $stmt->bindValue("limit",$limit,PDO::PARAM_INT);
    $stmt->execute();
    $return = $stmt->fetchAll();
    $stmt->closeCursor();
    return $return;

}

# Pour afficher la pagination dans la vue
// FONCTION de pagination
/**
 * @param int $nbtotalMessage
 * @param string $get
 * @param int $pageActu
 * @param int $perPage
 * @return string
 * Fonction qui génère le code HTML de la pagination
 * si le nombre de pages est supérieur à une.
 */
function pagination(int $nbtotalMessage, string $url="./?", string $get="page", int $pageActu=1, int $perPage=5 ): string
{
    $sortie = "";
    if ($nbtotalMessage === 0) return "";
    $nbPages = ceil($nbtotalMessage / $perPage);
    if ($nbPages == 1) return "";
    $sortie .= "<p>";
    for ($i = 1; $i <= $nbPages; $i++) {
        if ($i === 1) {
            if ($pageActu === 1) {
                $sortie .= "<< < 1 |";
            } elseif ($pageActu === 2) {
                $sortie .= " <a href='$url'><<</a> <a href='$url'><</a> <a href='$url'>1</a> |";
            } else {
                $sortie .= " <a href='$url'><<</a> <a href='$url&$get=" . ($pageActu - 1) . "'><</a> <a href='$url'>1</a> |";
            }
        } elseif ($i < $nbPages) {
            if ($i === $pageActu) {
                $sortie .= "  $i |";
            } else {
                $sortie .= "  <a href='$url&$get=$i'>$i</a> |";
            }
        } else {
            if ($pageActu >= $nbPages) {
                $sortie .= "  $nbPages > >>";
            } else {
                $sortie .= "  <a href='$url&$get=$nbPages'>$nbPages</a> <a href='$url&$get=" . ($pageActu + 1) . "'>></a> <a href='$url&$get=$nbPages'>>></a>";
            }
        }
    }
    $sortie .= "</p>";
    return $sortie;

}