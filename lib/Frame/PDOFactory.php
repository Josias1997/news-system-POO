<?php
namespace Frame;

class PDOFactory {
    public static function getMysqlConnection() {
        $db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');

        return $db;
    }
}
?>