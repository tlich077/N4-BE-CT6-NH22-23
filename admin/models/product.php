<?php
class Product extends Db{
    public function getAllProducts1()
    {
        $sql = self::$connection->prepare("SELECT * FROM products, manufactures,protypes Where products.manu_id = manufactures.manu_id
        AND products.type_id = protypes.type_id  ORDER BY id DESC");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getThongTinSP($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id='$id' ");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    
    // public function add($name,  $manu_id, $type_id,$price,$image, $description,$feature,$bestseller){
    //     $sql = self::$connection->prepare("INSERT INTO products (name, manu_id,type_id, price,image,description, feature, bestseller) VALUES
    //     ('$name','$manu_id','$type_id','$price','$image','$description','$feature','$bestseller')");
    //     $sql->execute(); //return an object 
    // }
    public function insertProduct($name, $manu_name, $type_name, $price, $image, $description, $feature,$bestseller)
    {
        $sql = self::$connection->prepare("INSERT INTO `products`(`name`, `manu_id`, `type_id`, `price`, `image`,`description`, `feature`,`bestseller`) VALUES (?,?,?,?,?,?,?,?)");
        $sql->bind_param('siiissii', $name, $manu_name, $type_name, $price, $image, $description, $feature,$bestseller);
        $sql->execute();
    }
    // public function sua($id,$name,  $manu_id, $type_id,$price,$image, $description,$feature,$bestseller){
    //     $sql = self::$connection->prepare("UPDATE products  SET name = '$name', manu_id= '$manu_id', type_id = '$type_id', price = '$price',
    //     image = '$image', description = '$description', feature= '$feature', bestseller= '$bestseller' WHERE  id = '$id'");
    //     $sql->execute(); //return an object
    // }
    public function editProduct($name, $manu_name, $type_name, $price, $image, $description, $feature,$bestseller, $id)
    {
        if($image != "")
        {
            $sql = self::$connection->prepare("UPDATE `products` SET `name`= ?,`manu_id`= ?,`type_id`= ?,`price`=?,`image`=?,`description`=?,`feature` = ?, `bestseller`= ?
            WHERE `id` = ?");
            $sql->bind_param("siiissiii", $name, $manu_name, $type_name, $price, $image, $description, $feature,$bestseller, $id);
            $sql->execute();
        }
        $sql = self::$connection->prepare("UPDATE `products` SET `name`= ?,`manu_id`= ?,`type_id`= ?,`price`=?,`description`=?,`feature` = ?, `bestseller`= ?
         WHERE `id` = ?");
        $sql->bind_param("siiisiii", $name, $manu_name, $type_name, $price, $description, $feature,$bestseller, $id);
        $sql->execute();
    }
    public function xoa($id){
        $sql = self::$connection->prepare("DELETE FROM products WHERE id = '$id'");
        $sql->execute(); //return an object 
    }
    public function search($keyword){
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `name` LIKE  ? or `manu_id` LIKE  ? or`type_id` LIKE  ? or`description` LIKE  ? or `price` LIKE  ? or`feature` LIKE  ? or`bestseller` LIKE  ? ");
        $keyword = "%$keyword%";
        $sql->bind_param("s",$keyword);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
}
