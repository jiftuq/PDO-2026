<?php
// 05-exercice/public/index.php

require_once __DIR__ . '/../config.php';
require_once ROOT_PROJECT . '/controller/routerController.php';

$page = $_GET['page'] ?? '';

switch ($page) {
    case 'commentaires':
        readCommentaires();
        break;
    case 'ajouter':
        addCommentaire();
        break;
    default:
        homepage();
        break;
}
