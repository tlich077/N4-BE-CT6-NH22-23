
<?php include "header.php"; ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./images/apple-macbook-air-m1-2020-z124000de-1-org.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptop<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./images/iphone-14-pro-tim-1-1.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Accessories<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./images/dell-gaming-g15-54dgr-1.jpg" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Cameras<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <?php foreach ($getOneProtypes as $value) : ?>
                            <li class="active"><a data-toggle="tab" href="#tab1"><?= $value['type_name'] ?></a></li>
                            <?php endforeach; ?>
                            <?php foreach ($getFourProtypes as $value) : ?>
                            <li><a data-toggle="tab" href="#tab1"><?= $value['type_name'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                <?php foreach ($getNewProducts as $value) : ?>
                                    
                                <div class="product">
                                    <div class="product-img">
                                        <img  src="./images/<?php echo $value['image'] ?> ">
                                       
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">Category</p>
                                        <h3 class="product-name"><a
                                                href="product.php?id=<?php echo $value["id"] ?>"><?php echo $value['name'] ?></a>
                                        </h3>
                                        <h4 class="product-price"><?php echo number_format($value['price']) ?><del
                                                class="product-old-price"></del></h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist" onclick="addWishlist(<?php echo $value['id'] ?>)"><i class="fa fa-heart-o"></i><span
                                                    class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp">quick view</span></button>
                                        </div>
                                    </div> 
                                    
                                    <div  class="add-to-cart">
                                    
                                        <button style="color: white" class="add-to-cart-btn" > <a 
                                                href="cart.php?id=<?php echo $value["id"];?>"><i 
                                                    class="fa fa-shopping-cart"></i>add to
                                                cart</a></button>
                                    </div>
                                
                                </div>
                                <!-- /product -->
                                <?php endforeach; ?>
                             
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <?php foreach ($getOneProtypes as $value) : ?>
                            <li class="active"><a data-toggle="tab" href="#tab1"><?= $value['type_name'] ?></a></li>
                            <?php endforeach; ?>
                            <?php foreach ($getFourProtypes as $value) : ?>
                            <li><a data-toggle="tab" href="#tab1"><?= $value['type_name'] ?></a></li>
                            <?php endforeach; ?>
                    </div>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /section title -->

        <!-- Products tab & slick -->
        <div class="col-md-12">
            <div class="row">
                <div class="products-tabs">
                    <!-- tab -->
                    <div id="tab2" class="tab-pane fade in active">
                        <div class="products-slick" data-nav="#slick-nav-2">
                            <!-- product -->
                            <?php foreach ($getTopSellingProducts as $value) : ?>
                            <div class="product">
                                <div class="product-img">
                                    <img src="./images/<?php echo $value['image'] ?>">
                                 
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Category</p>
                                    <h3 class="product-name"><a
                                            href="product.php?id=<?php echo $value["id"] ?>"><?php echo $value['name'] ?></a>
                                    </h3>
                                    <h4 class="product-price"><?php echo number_format($value["price"]) ?><del class="product-old-price">$990.00</del>
                                    </h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist" onclick="addWishlist(<?php echo $value['id'] ?>)"><i class="fa fa-heart-o"></i><span
                                                class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                                view</span></button>
                                    </div>
                                </div>
                                
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><a
                                                href="cart.php?id=<?php echo $value["id"];?>"><i
                                                    class="fa fa-shopping-cart"></i>add to
                                                cart</a></button>
                                </div>
                            </div>
                            <!-- /product -->
                            <?php endforeach; ?>
                        </div>
                        <!-- <div id="slick-nav-2" class="products-slick-nav"></div> -->
                    </div>
                    <!-- /tab -->
                </div>
            </div>
        </div>
        <!-- /Products tab & slick -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
       <!-- Products tab & slick -->
       <h1>Feature</h1>
       <div class="col-md-12">
            <div class="row">
                <div class="products-tabs">
                    <!-- tab -->
                    <div id="tab2" class="tab-pane fade in active">
                        <div class="products-slick" data-nav="#slick-nav-2">
                            <!-- product -->
                            <?php foreach ($getTopSellingProductsBottom as $value) : ?>
                            <div class="product">
                                <div class="product-img">
                                    <img src="./images/<?php echo $value['image'] ?>">
                                 
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Category</p>
                                    <h3 class="product-name"><a
                                            href="product.php?id=<?php echo $value["id"] ?>"><?php echo $value['name'] ?></a>
                                    </h3>
                                    <h4 class="product-price"><?php echo number_format($value["price"]) ?><del class="product-old-price">$990.00</del>
                                    </h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist" onclick="addWishlist(<?php echo $value['id'] ?>)"><i class="fa fa-heart-o"></i><span
                                                class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                                view</span></button>
                                    </div>
                                </div>
                                
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><a
                                                href="cart.php?id=<?php echo $value["id"];?>"><i
                                                    class="fa fa-shopping-cart"></i>add to
                                                cart</a></button>
                                </div>
                            </div>
                            <!-- /product -->
                            <?php endforeach; ?>
                        </div>
                        <!-- <div id="slick-nav-2" class="products-slick-nav"></div> -->
                    </div>
                    <!-- /tab -->
                </div>
            </div>
        </div>
        <!-- /Products tab & slick -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php include "footer.php"; ?>