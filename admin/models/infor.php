<?php
class Infor extends Db{
    public function getInfors()
    {
        $sql = self::$connection->prepare("SELECT * FROM infor ORDER By id DESC");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getInsertInfo($firstname,$lastname,$address, $tel, $code_order)
    {
        $sql = self::$connection->prepare("INSERT INTO `infor`(`fname`, `lname`, `address`, `tel`, `code_order`)
        VALUES (?,?,?,?,?)");
        $sql->bind_param('sssii',$firstname,$lastname,$address, $tel,$code_order );
        $sql->execute(); 
    }
}



