<?php 
namespace Model;

use Frame\Manager;
use Entity\Comment;

abstract class CommentsManager extends Manager {
    abstract protected function add(Comment $comment);



    public function save(Comment $comment) {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        }
        else 
        {
            throw new \RuntimeException('The comment must be validate to before being saved');
        }
    }

    abstract public function getListOf($news);
}
?>