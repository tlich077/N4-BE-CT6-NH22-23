<?php 
session_start();
        require "config.php";
        require "models/db.php";
        require "models/protype.php";
        $protype = new Protype();
        $getAllProtype = $protype -> getAllProtypes();
        $type_name = $_POST['type_name'];
        if(isset($_SESSION["getID"])){
            $type_id = $_SESSION["getID"];
       $edit = $protype -> Edit($type_name,$type_id);
    }
    header('location:protype.php');
