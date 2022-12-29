<?php
class Comment extends Db{
    // public function getAllImages(){
    //     $sql = self::$connection->prepare("SELECT * FROM images Order by 'id_img' desc");
    //     $sql->execute();//return an object
    //     $items=array();
    //     $items=$sql->get_result()->fetch_all(MYSQLI_ASSOC);
    //     return $items;
    // }

    public function getCommentId($id){
        $sql = self::$connection->prepare("SELECT * FROM `comment` WHERE id='$id'");
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