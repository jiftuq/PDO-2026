<?php

// utilisez le typage si possible

// ajout d'un commentaire
function addOneCommentaire(PDO $db, string $email, string $full_name, string $title, string $text_comment): bool
{
    // traitement des variables
    $email=filter_var($email,FILTER_VALIDATE_EMAIL);
    $text_comment=htmlspecialchars(trim(strip_tags($text_comment)));
    $full_name = htmlspecialchars(trim(strip_tags($full_name)));
    $title = htmlspecialchars(trim(strip_tags($title)));
    
    // on envoie false si il y a une seule erreur
      if($email===false           ||
    strlen($email)>120            ||
    empty($full_name)             ||
    strlen($full_name)<5          ||
    strlen($full_name)>120        ||
    empty($title)                 ||
    strlen($title)<5              ||
    strlen($title)>180            ||
    empty($text_comment)          ||
    strlen($text_comment)<5       ||
    strlen($text_comment)>1000   
    ) return false;

    // préparation de la requête avec des marqueurs non nommés
    $stmt = $db->prepare("INSERT INTO `commentaire` (`email`, `full_name`, `title`, `text_comment`) VALUES (?,?,?,?);");
    // attribution des variables
    // $stmt->bindValue(1,$email,PDO::PARAM_STR);
    // $stmt->bindValue(2,$full_name);
    // $stmt->bindValue(3,$title);
    // $stmt->bindValue(4,$text_comment);

    // insertion
    $insert = $stmt->execute([$email,$full_name,$title,$text_comment]);
    // bonne pratique
    $stmt->closeCursor();
    // return envoi true si réussi, false en cas d'échec
    return $insert;
}

// chargement de tous les commentaires
function readCommentaires(PDO $db): array
{
    // requête
    $stmt = $db->query("SELECT * FROM `commentaire` ORDER BY `post_date` DESC");
    // recupération des resultats en fetch_assoc (voir connexion)
    $result = $stmt->fetchAll();
    // bonne pratique
    $stmt->closeCursor();
    // retour
    return $result;
}

// bonus pagination

// on récupère le nombre total d'articles
function countCommentaires(PDO $db): int
{
    // $stmt = $db->query("SELECT COUNT(*) AS nb FROM `commentaire`");
    // $nb = (int) $stmt->fetch()['nb'];
    $stmt = $db->query("SELECT COUNT(*) FROM `commentaire`");
    $nb = (int) $stmt->fetchColumn();
    $stmt->closeCursor();
    return $nb;
}

// chargement des commentaires de la page
function readPageCommentaires(PDO $db, int $offset=0, int $limit=5): array
{
    // requête prépare
    $stmt = $db->prepare("SELECT * FROM `commentaire` ORDER BY `post_date` DESC LIMIT :offset, :limit;");
    // utilisation obligatoire de bindParam ou bindValue
    $stmt->bindValue(":offset",$offset,PDO::PARAM_INT);
    $stmt->bindValue(":limit",$limit,PDO::PARAM_INT);
    $stmt->execute();
    // recupération des resultats en fetch_assoc (voir connexion)
    $result = $stmt->fetchAll();
    // bonne pratique
    $stmt->closeCursor();
    // retour
    return $result;
}

// fonction de pagination
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