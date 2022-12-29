
<?php
        session_start();
        require "config.php";
        require "models/db.php";
        require "models/product.php";
        require "models/protype.php";
        require "models/manufacture.php";
        $manufactures = new Manufacture();
        $products = new Product();
        $protypes = new Protype();
        $getAllProducts = $products -> getAllProducts1();
        $name = $_POST['name'];
        $manu_name = $_POST['manu_name'];
        $type_name = $_POST['type_name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $description = $_POST['description'];
        $feature = isset($_POST['feature'])?1:0;
        $bestseller = $_POST['bestseller'];
        if(isset($_SESSION["getID"])){
                $id = $_SESSION["getID"];
           $edit = $products -> editProduct($name, $manu_name, $type_name, $price, $image, $description, $feature,$bestseller, $id);
        }
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
        header('location:product.php');
    

?>