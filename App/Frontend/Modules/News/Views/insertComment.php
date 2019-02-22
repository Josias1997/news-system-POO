<h2>Add a comment</h2>
<form action="" method="post">
  <p>
    <?= isset($errors) && in_array(\Entity\Comment::INVALID_AUTHOR, $errors) ? 'Invalid author.<br />' : '' ?>
    <label>Pseudo</label>
    <input type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment['author']) : '' ?>" /><br />
    
    <?= isset($errors) && in_array(\Entity\Comment::INVALID_CONTENT, $errors) ? 'Invalid content.<br />' : '' ?>
    <label>Content</label>
    <textarea name="content" rows="7" cols="50"><?= isset($comment) ? htmlspecialchars($comment['content']) : '' ?></textarea><br />
    
    <input type="submit" value="Comment" />
  </p>
</form>