<?php 
namespace Entity;

use Frame\Entity;

class News extends Entity
{
    protected $author,
    $title,
    $content,
    $date_add,
    $date_modification;

    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_CONTENT = 3;

    public function isValid() {
        return !(empty($this->author) || empty($this->title) ||
        empty($this->content));
    }

    public function setAuthor($author) {
        if (!is_string($author) || empty($author))
        {
            $this->errors[] = self::INVALID_AUTHOR;
        }

        $this->author = $author;
    }

    public function setTitle($title) {
        if (!is_string($title) || empty($title)) {
            $this->errors[] = self::INVALID_TITLE;
        }

        $this->title = title;
    }

    public function setContent($content) {
        if (!is_string($content) || empty($content)) {
            $this->errors[] = self::INVALID_CONTENT;
        }

        $this->content = $content;
    }

    public function setDate_Add(\DateTime $date_add)
    {
      $this->date_add = $date_add;
    }
  
    public function setDate_Modification(\DateTime $date_modification)
    {
      $this->date_modification = $date_modification;
    }
  
    // GETTERS //
  
    public function author()
    {
      return $this->author;
    }
  
    public function title()
    {
      return $this->title;
    }
  
    public function content()
    {
      return $this->content;
    }
  
    public function date_add()
    {
      return $this->date_add;
    }
  
    public function date_modification()
    {
      return $this->date_modification;
    }

}
?>