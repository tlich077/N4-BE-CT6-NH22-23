<?php
class Protype extends Db{
    public function getAllProtypes()
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getOneProtypes()
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes ORDER BY `type_id` ASC LIMIT 0,1");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getFourProtypes()
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes ORDER BY `type_id` ASC LIMIT 1,4");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
   
   
   
}