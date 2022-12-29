<?php
        require "config.php";
        require "models/db.php";
        require "models/user.php";
        
        $user=new User;
    
       
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $retypepassword =  md5($_POST['retypepassword']);
            if (!$username || !$password || !$fullname || !$retypepassword)
            {
                echo "<script> alert('Please enter full information') </script>";
            }
            else
            {
                $getUserByUsername = $user -> getUserByUsername($username);
                
                if ($getUserByUsername!=null) {
                    foreach($getUserByUsername as $value){
                        if(strcasecmp($value['username'], $username) == 0){
                            echo "<script> alert('Username already used,Please enter another username') </script>";
                            break;
                        }
                        else if($password==$retypepassword)
                        { 
                            $getInsertUser = $user -> getInsertUser($fullname,$username,$password);
                            header('location:user.php');
                        }
                    }
                    
                }
                else
                { 
                    $getInsertUser = $user -> getInsertUser($fullname,$username,$password);
                    echo "<script> alert('Registration successful') </script>";
                    header('location:user.php');
                }
                
            }  
            
        
        
    
?>