<?php
require("config.php");
require("models/db.php");
require("models/product.php");
require("models/manufacture.php");
require("models/protype.php");
require("models/user.php");
require("models/comment.php");
$product = new Product;
$protype = new Protype;
$manufacture = new Manufacture;
$user = new User;
$comment= new Comment;
if(isset($_POST['username_sign'])){
    $sdt = $_POST['sdt'];
    $username=$_POST['username_sign'];
    $password = $_POST['password_sign'];
    // $user->add($sdt,$username,$password,2);
    header('location:login.php');  
}

if(isset($_POST['email'])){
    $id = $_POST['id'];
    $name=$_POST['name'];
    $email = $_POST['email'];
    $review = $_POST['review'];
    $star = $_POST['star'];
    $comment->add($id,$name,$email,$review,$star);
    header("location:product.php?id=$id");  
}


