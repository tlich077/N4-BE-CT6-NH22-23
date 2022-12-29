<?php
class Protype extends Db{
    public function getAllProtypes()
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes ORDER BY type_id DESC");
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
    public function addProtyes($type_name){
        $sql = self::$connection->prepare("INSERT INTO protypes (type_name) VALUES
        ('$type_name')");
        $sql->execute(); //return an object 
    }
    public function xoaProtyes($id){
        $sql = self::$connection->prepare("DELETE FROM protypes WHERE type_id = '$id'");
        $sql->execute(); //return an object 
    }
    public function Edit($type_name ,$type_id)
    {
        $sql = self::$connection->prepare("UPDATE `protypes` SET type_name =? where type_id = ?" );
        $sql->bind_param("si", $type_name,$type_id );
        $sql->execute();
    }
    public function getThongTinSP($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_id= $id ");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
}