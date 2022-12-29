<?php
class Infor extends Db{
    public function getInfors()
    {
        $sql = self::$connection->prepare("SELECT * FROM infor");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getInsertInfo($firstname,$lastname,$address, $tel, $code_order)
    {
        $sql = self::$connection->prepare("INSERT INTO `infor`(`fname`, `lname`, `address`, `tel`, `code_order`)
        VALUES (?,?,?,?,?)" );
        $sql->bind_param('sssii',$firstname,$lastname,$address, $tel,$code_order );
        $sql->execute(); 
    }
    public function getInforById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM infor WHERE id = ?");
        $sql->bind_param("i",$id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }


}



