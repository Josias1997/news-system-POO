<?php
namespace Model;

use Model\NewsManager;
use Entity\News;
class NewsManagerPDO extends NewsManager {
    public function getList($debut = -1, $limit = -1)
    {
        $sql = 'SELECT id, author, title, content, date_add, date_modification
        FROM news ORDER BY id DESC';

        if ($debut != -1 || $limit != -1) {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $debut;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        $listNews = $request->fetchAll();

        foreach ($listNews as $news) {
            $news->setDate_Add(new \DateTime($news->date_add()));
            $news->setDate_Modification(new \DateTime($news->date_modification));
        }

        $request->closeCursor();

        return $listNews;
    }

    public function getUniq($id) {
        $request = $this->dao->prepare('SELECT id, author, title, content, date_add,
        date_modification FROM news WHERE id = :id');

        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Entity\News');

        if ($news = $request->fetch()) {
            $news->setDate_Add(new \DateTime($news->date_add()));
            $news->setDate_Modification(new \DateTime($news->date_modification));

            return $news;
        }

        return null;
    }

    public function count() {
        return $this->dao->query("SELECT COUNT(*) FROM news")->fetchColumn();
    }
}
?>