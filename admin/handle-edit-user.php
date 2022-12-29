<?php
        session_start();
        require "config.php";
        require "models/db.php";
        require "models/user.php";
        //$_SESSION["getID"] = $_GET["id"];
        $user=new User();
    
       
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $retypepassword =  md5($_POST['retypepassword']);
        if(isset($_SESSION['getID'])){
                $id=$_SESSION['getID'];
                
                if (!$username || !$password || !$fullname || !$retypepassword)
                {
                    echo "<script> alert('Please enter full information') </script>";
                }
                else
                {      
                    if($password==$retypepassword)
                    { 
                        $edits = $user -> Edit($id,$fullname,$username,$password);
                        header('location:user.php');
                    }
                        
                        
                }
                    
                    
                    
                
        }  
        
            
           
        
    
?>