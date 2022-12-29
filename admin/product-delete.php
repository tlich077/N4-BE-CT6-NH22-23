<?php
    require "config.php";
    require "models/db.php";
    require "models/product.php";
    $products = new Product;
    if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        $xoa = $products -> xoa($id);
        header('location:product.php');
    }
?>