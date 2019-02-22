<?php

namespace Entity;

use Frame;

class Comment extends Entity {
    protected $news;
    protected $auteur;
    protected $content;
    protected $date;

    const INVALID_AUTHOR = 1;
    const INVALID_CONTENT = 2;

    public function isValid() {
        return !(empty($this->author) || empty($this->content));
    }

    public function setNews($news) {
        $this->news = (int) $news;
    }

    public function setAuthor($author) {
        if (!is_string($author) || empty($author)) {
            $this->errors[] = self::INVALID_AUTHOR;
        }

        $this->author = $author;
    }

    public function setContent($content) {
        if (!is_string($content) || empty($content)) {
            $this->errors[] = self::INVALID_CONTENT;
        }

        $this->content = $content;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    public function news() {
        return $this->news;
    }

    public function author()
    {
      return $this->author;
    }
  
    public function content()
    {
      return $this->content;
    }
  
    public function date()
    {
      return $this->date;
    }
}
?>