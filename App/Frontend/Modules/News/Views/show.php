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