<?php
        require "config.php";
        require "models/db.php";
        require "models/product.php";
        require "models/protype.php";
        require "models/manufacture.php";
        $manufactures = new Manufacture();
        
        
    
        $manu_name = $_POST['manu_name'];
        $add = $manufactures -> addManufacture($manu_name);
        header('location:manufacture.php');
    
?>