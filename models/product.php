<?php
class Product extends Db{
    public function getAllProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getTenProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY `manu_id` ASC LIMIT 0,15");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getNewProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,10");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getTopSellingProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE bestseller > 200");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getTopSellingProducttt()
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE bestseller > 800");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    
   
    public function getTopSellingProductsBottom()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY feature = 1 DESC LIMIT 0,8");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getTopSellingProductsBottom1()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY bestseller > 400 DESC LIMIT 0,4");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getTopSellingProductsBottom2()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY bestseller > 800 DESC LIMIT 0,4");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getProductById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i",$id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getProductByIdType($type_id)
    {
        /// truyền số thì ko dùng ``;
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id = ? ORDER BY type_id ASC LIMIT 0,4 ");
        $sql->bind_param("i",$type_id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function search($keyword){
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `description` LIKE  ?");
        $keyword = "%$keyword%";
        $sql->bind_param("s",$keyword);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function Manu(){
        $sql = self::$connection->prepare("SELECT * FROM products where manu_id");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    // public function ADD(){
    //     $sql = self::$connection->prepare("INSERT INTO products(name,manu_id,type_id,price,image,description,feature,created_at,bestseller) VALUES("$name",$manu_id,$type_id,$price,"$image","$description",$feature,$created_at,$bestseller)");
    //     $sql->execute(); //return an object
    //     $items = array();
    //     $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    //     return $items; //return an array
    // }

    public function getProductById1($id){
        $sql = self::$connection->prepare("SELECT * FROM products INNER JOIN manufactures on products.manu_id = manufactures.manu_id INNER JOIN
        protypes on products.type_id = protypes.type_id WHERE products.id = ? ");
        $sql->bind_param("i",$id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    
    public function getCountPhone(){
        $sql = self::$connection->prepare("SELECT COUNT(type_id) FROM products where type_id = 1");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getImage($startImages,	$imagess ){
        $data = null;
        $sql = "SELECT * FROM products Limit $startImages, $imagess";
        $result =self::$connection->query($sql);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $data[] =$row;
            }
            return $data;
        }
    }
       
    function getAllProduc($page, $perPage)
    {
        // Tính số thứ tự trang bắt đầu
        $firstLink = ($page - 1) * $perPage;
        //Dùng LIMIT để giới hạn số lượng hiển thị 1 trang
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `id` LIMIT $firstLink, $perPage");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    function paginate($url, $total, $perPage)
    {
        $totalLinks = ceil($total / $perPage);
        $link = "";
        for ($j = 1; $j <= $totalLinks; $j++) {
            $link = $link . "<a href='$url?page=$j'><li> $j</li></a>";
        }
        return $link;
    }
    public function searchProducts($keyword)
    {
        //Tim kiem
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `name`  LIKE ?");
        $keyword = "%$keyword%";
        $sql->bind_param("s",$keyword);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getsearchProducts($page, $perPage,$keyword)
    {
        $fistLink = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products WHERE `name`  LIKE ? LIMIT $fistLink,$perPage ");
        $keyword = "%$keyword%";
        $sql->bind_param("s",$keyword);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function paginateOfSearch($url, $total,$page, $perPage,$offset,$keyword,$type_prd)
    {
        if($total <= 0) {
            return "";
        }
        $totalLinks = ceil($total/$perPage);
        if($totalLinks <= 1) {
        return "";
        }
        $from = $page - $offset;
        $to = $page + $offset;
        //$offset quy định số lượng link hiển thị ở 2 bên trang hiện hành
        //$offset = 2 và $page = 5,lúc này thanh phân trang sẽ hiển thị: 3 4 5 6 7
        if($from <= 0) {
        $from = 1;
        $to = $offset * 2;
        }
        if($to > $totalLinks) {
        $to = $totalLinks;
        }       
        $links = array();
        $link = "";
        for ($j = $from; $j <= $to; $j++) {
            
            if($j != $_GET['pages'])
            {
                $link = $link."<li><a href = '$url?type_prd=$type_prd&&keyword=$keyword&&pages=$j'> $j </a>";              
            }
            else
            {
                $link = $link."<li class='active'><a href = '$url?type_prd=$type_prd&&keyword=$keyword&&pages=$j'> $j </a></li>";
            }           
        }
        return $link; 
    }
}
