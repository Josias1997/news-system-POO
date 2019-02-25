<p>
Par 
<em><?= $news['author'] ?></em>, 
le <?= $news['date_add']->format('d/m/Y à H\hi') ?>
</p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['content']) ?></p>

<?php 
if ($news['date_add'] != $news['date_modification']) 
{ 
?>
    <p style="text-align: right;">
    <small>
        <em>Modified on <?= $news['date_modification']->format('d/m/Y à H\hi') ?></em>
    </small>
    </p>
<?php 
} 
?>

<p><a href="comment-<?= $news['id'] ?>.html">Add a comment</a></p>

<?php
if (empty($comments))
{
?>
<p>There isn't any comment. Be the first to make a comment</p>
<?php
}

foreach ($comments as $comment)
{
?>
  <fieldset>
    <legend>
      Posted by <strong><?= htmlspecialchars($comment['author']) ?></strong> on <?= $comment['date']->format('Y/m/d à H\hi') ?>
    </legend>
    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
  </fieldset>
<?php
}
?>

<p><a href="comment-<?= $news['id'] ?>.html">Add a comment</a></p>