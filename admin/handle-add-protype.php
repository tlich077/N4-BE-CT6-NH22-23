<?php
        require "config.php";
        require "models/db.php";
        require "models/product.php";
        require "models/protype.php";
        require "models/manufacture.php";
        $manufactures = new Manufacture();
        $products = new Product();
        $protypes = new Protype();
        $getAllProtypes = $protypes -> getAllProtypes();
        
    
        $type_name = $_POST['type_name'];
        $add = $protypes -> addProtyes($type_name);
        header('location:protype.php');
    
?>