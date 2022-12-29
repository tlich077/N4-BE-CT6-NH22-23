<?php
    require "config.php";
    require "models/db.php";
    require "models/protype.php";
    $protype = new Protype;
    if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        $xoa = $protype -> xoaProtyes($id);
        header('location:protype.php');
    }
?>