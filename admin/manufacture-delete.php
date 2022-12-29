<?php
    require "config.php";
    require "models/db.php";
    require "models/manufacture.php";
    $manufacture = new Manufacture;
    if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        $xoa = $manufacture -> xoaManufacture($id);
        header('location:manufacture.php');
    }
?>