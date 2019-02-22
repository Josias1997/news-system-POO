<?php
namespace Model;

use Frame\Manager;

abstract class NewsManager extends Manager {
    abstract public function getList($debut = -1, $limit = -1);


    abstract public function getUniq($id);
}
?>