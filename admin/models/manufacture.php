<?php
class Manufacture extends Db{
    public function getAllManus()
    {
        $sql = self::$connection->prepare("SELECT * FROM manufactures  ORDER BY manu_id DESC");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getFourManus()
    {
        $sql = self::$connection->prepare("SELECT * FROM manufactures ORDER BY `manu_id` ASC LIMIT 0,4");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function addManufacture($manu_name){
        $sql = self::$connection->prepare("INSERT INTO manufactures (manu_name) VALUES
        ('$manu_name')");
        $sql->execute(); //return an object 
    }
    public function xoaManufacture($id){
        $sql = self::$connection->prepare("DELETE FROM manufactures WHERE manu_id = '$id'");
        $sql->execute(); //return an object 
    }
    public function getThongTinSP($id)
        {
            $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_id= $id ");
            $sql->execute(); //return an object
            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            return $items; //return an array
        }
        public function editManu($manu_name, $manu_id)
        {
            $sql = self::$connection->prepare("UPDATE `manufactures` SET  manu_name = ? WHERE manu_id = ?");
            $sql->bind_param("si", $manu_name, $manu_id);
            $sql->execute();
        }
}