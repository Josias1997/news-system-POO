<?php 
foreach($listNews as $news) {

?>
    <h2>
        <a href = "new-<?= $news['id'] ?>.html">
            <? $news['title'] ?>
        </a>
    </h2>
    <p>
        <?= nl2br($news['content']) ?>
    </p>
<?php
}
?>