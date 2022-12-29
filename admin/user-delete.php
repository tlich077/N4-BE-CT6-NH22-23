<?php
    require "config.php";
    require "models/db.php";
    require "models/user.php";
    $user = new User;
    if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        $xoa = $user -> xoaUser($id);
        header('location:user.php');
    }
?>