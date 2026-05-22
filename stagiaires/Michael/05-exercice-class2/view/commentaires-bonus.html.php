<?php require __DIR__ . '/_header.html.php'; ?>

<h1>Commentaires</h1>

<?php if ($nbCommentaires === 0): ?>
    <h2>Pas encore de commentaire</h2>
<?php elseif ($nbCommentaires === 1): ?>
    <h2>Il y a 1 commentaire</h2>
<?php else: ?>
    <h2>Il y a <?= $nbCommentaires ?> commentaires</h2>
<?php endif; 
echo $pagination;
?>

<?php foreach ($commentaires as $c): ?>
    <div class="comment-card">
        <h3><?= htmlspecialchars($c['title']) ?></h3>
        <p class="meta">
            Par <?= htmlspecialchars($c['full_name']) ?> — <?= htmlspecialchars($c['post_date']) ?>
        </p>
        <p><?= nl2br(htmlspecialchars($c['text_comment'])) ?></p>
    </div>
<?php endforeach; 
echo $pagination;
?>

<div class="page-actions">
    <a href="#" class="btn">Haut de page ↑</a>
    <a href="./?section=ajouter" class="btn">Ajouter un commentaire</a>
</div>

<?php require __DIR__ . '/_footer.html.php'; ?>
