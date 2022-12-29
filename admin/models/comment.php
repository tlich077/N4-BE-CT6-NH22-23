<?php
class Comment extends Db{
    public function getComments()
    {
        $sql = self::$connection->prepare("SELECT * FROM comment ORDER By id_cmt DESC");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function getCommentId($id){
        $sql = self::$connection->prepare("SELECT * FROM `comment` WHERE id=$id");
        $sql->execute();//return an object
        $items=array();
        $items=$sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function add($id,$name,$email,$review,$star)
    {
        $sql = self::$connection->prepare("INSERT INTO `comment`(`id`,`name`,`email`,`review`,`star`) VALUES (?,?,?,?,?)");
        $sql->bind_param("isssi",$id,$name,$email,$review,$star);
        return $sql->execute();
    }
}