<?php
namespace Frame;

class PDOFactory {
    public static function getMysqlConnection() {
        $db = new \PDO('mysql:host=localhost;dbname=news-system;charset=utf8', 'root', '', []);

        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}
?>