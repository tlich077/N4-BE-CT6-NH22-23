<?php 
    session_start();
 ?>
<?php
	require "config.php";
	require "models/db.php";
	require "models/product.php";
	require "models/protype.php";
	require "models/manufacture.php";
	$product = new Product;
	$protype = new Protype;
	$manufacture = new Manufacture;
	$getAllProducts = $product -> getAllProducts();
	$getAllProtypes = $protype -> getAllProtypes();
	$getAllManus = $manufacture -> getAllManus();
	$getOneProtypes =  $protype->getOneProtypes();
	$getFourProtypes =  $protype->getFourProtypes();
	$getNewProducts = $product->getNewProducts();
	$getTopSellingProducts = $product-> getTopSellingProducts();
	$getTopSellingProductsBottom = $product-> getTopSellingProductsBottom();
    $getTopSellingProductsBottom1 = $product -> getTopSellingProductsBottom1();
    $getTopSellingProductsBottom2 = $product -> getTopSellingProductsBottom2();
    $getTopSellingProducttt = $product -> getTopSellingProducttt();
	$getFourManus = $manufacture -> getFourManus();
    $Manu = $product -> Manu();
    $totalwishlist = 0;
    $totalCart = 0;
    $totalPrice = 0;
    if (isset($_SESSION['wishlist'])):
        foreach ($_SESSION['wishlist'] as $key3 => $value3) {
            $totalwishlist += $value3;
        }
    endif;
    if (isset($_SESSION['cart'])) :
        foreach ($_SESSION['cart'] as $key2 => $value2) {
            $totalCart += $value2;
        }
    endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>STORE GR4</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> tlt077@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>

                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    <?php
                        if (isset($_SESSION['username'])) {
                            ?><li><a><i class="fa fa-user-o"></i> <?php echo $_SESSION['username']; ?> </a></li> <?php
                        }
                        else{
                            ?><li><a href="login.php"><i class="fa fa-user-o"></i>Login</a></li> 
                              <li><a href="register.php"><i class="fa fa-user-o"></i>Register</a></li>
                             <li><a href="admin/login.php">MANAGE</a></li>
                            <?php
                           
                        }
                    ?>
                   
                   
                    <?php
                        if (isset($_SESSION['username'])) {
                            ?> <li><a href="logout.php">Logout</a></li> <?php
                            ?>  <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="./img/logo1.png" width="80%" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <!-- SEARCH -->
                            <form method="get" action="results.php">
                                <select class="input-select" name="type_prd">
                                    <option value="0">All Categories</option>
                                    <?php									
					                foreach ($getAllProtypes as $value) { ?>
                                    <option  value="<?php echo $value["type_id"] ?>"><?php echo $value["type_name"] ?>
                                    <?php } ?>
                                </select>
                                <input class="input" placeholder="Search here" name="keyword">
                                <button class="search-btn" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->

                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div class="dropdown">
                            <a href="showwlist.php">
									<i class="fa fa-heart-o"></i>
									<span>Your Wishlist</span>
									<div class="qty"><?php echo $totalwishlist ?></div>
								</a>
								
							</div>
								
                            <!-- /Wishlist -->
                            
                            <!-- Cart -->
                            <div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
									<div class="qty"><?php echo $totalCart ?></div>
								</a>
                                
								<div class="cart-dropdown">
									<div class="cart-list">
                                    <?php if (isset($_SESSION['cart'])):
											foreach ($_SESSION['cart'] as $key => $value) :
                                                $getProductById1 = $product -> getProductById1($key);
												foreach($getProductById1 as $p):
										?>
												<div class="product-widget">
													<div class="product-img">
														<img src="./images/<?= $p['image'] ?>" alt="">
													</div>
													<div class="product-body">
														<h3 class="product-name"><a href="#"><?= $p['name'] ?></a></h3>
														<h4 class="product-price"><span class="qty">X<?= $value ?></span><?= number_format($p['price']) ?>VND</h4>
													</div>
													<button class="delete"><a href="del.php?id=<?php echo $key ?>"
                                                    style="color: white"><i class="fa fa-close"></i></a></button>
                                      
												</div>
                                                <?php $totalPrice += $value * $p['price']; ?>
                                                <?php endforeach; endforeach;
										 ?>
									</div>
									<div class="cart-summary">
										<small style="font-weight: bold">SUBTOTAL: <span style="font-weight: bold;font-size:15px"><?php echo number_format($totalPrice); ?></span></small>

									</div>
									<div class="cart-btns">
										<a href="viewcart.php?id=<?php if(isset($key)) echo $key ?>">View Cart</a>
										<a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
                                <?php 
									endif; ?>
							</div>
                    
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <?php foreach ($getAllProtypes as $value) : ?>
                    <li><a
                            href="store.php?type_id=<?php echo $value["type_id"] ?>&&pages=1"><?php echo $value["type_name"] ?></a>
                    </li>
                    <?php endforeach; ?>

                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>

    <!-- /NAVIGATION -->
