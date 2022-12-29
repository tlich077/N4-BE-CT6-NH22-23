<?php
class Manufacture extends Db{
    public function getAllManus()
    {
        $sql = self::$connection->prepare("SELECT * FROM manufactures ");
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
    
}