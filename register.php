<?php    
    require "config.php";
    require "models/db.php";
    require "models/user.php";
    $user=new User;
    
    if(isset($_POST['submit'])){
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
                        echo "<script> alert('Registration successful') </script>";
                    }
                }
            }
            else
            { 
                $getInsertUser = $user -> getInsertUser($fullname,$username,$password);
                echo "<script> alert('Registration successful') </script>";
            }
        }  
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <title>Register</title>
</head>

<body>
   <div class="content-wrapper">
        <div class="content">
            <div class="signup-wrapper shadow-box">
                <div class="company-details ">
                  
                    <div class="shadow"></div>
                    <div class="wrapper-1">
                        <div class="logo">
       <div class="icon-food">
         
                    </div>
                        </div>
                        <h1 class="title">Register Account</h1>
                        <!-- <div class="slogan">Hello</div> -->
                    </div>

                </div>
                <div class="signup-form ">
                    <div class="wrapper-2">
                        <div class="form-title">Sign up today!</div>
                        <div class="form">
                            <form method="post">
                                <p class="content-item">
                                    <label class='chu'>FullName
                                    <input type="text" name="fullname" id="">
                                    </label>
                                </p>

                                <p class="content-item">
                                    <label class='chu'>Username
                                        <input type="text" name="username" id=""  ">
                                    </label>
                                </p>

                                <p class="content-item">

                                    <label class='chu'>Password
                                        <input type="password" name="password" id="">
                                    </label>
                                </p>
                                 <p class="content-item">

                                    <label class='chu'>Repassword
                                        <input type="password" name="retypepassword" id=""> <br>
                                    </label>
                                </p>


                                <button class="login" type="submit" name="submit">Register</button>
                                
                                <a href="login.php" class="login" >Login now </a>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- pattern="[a-z]{1,15} -->

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

</body>

</html>






