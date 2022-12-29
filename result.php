<?php
include 'header.php' ?>
<?php 

	if (isset($_GET['keyword'])){
		$key = $_GET['keyword'];	
	}
	$searchProducts = $product->searchProducts($key);
	
    //if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $e = array();   
        if(($_GET['type_prd']) == 0)
        {     
            foreach($getAllProtypes as $k)
            {
                array_push($e,$k['type_id']);    
            }               
        }      
        else{
            $e['type_prd'] = $_GET['type_prd'];
        }
    $perPage = 6;
    $pages = $_GET['pages'];
    $total = 0;
    foreach($searchProducts as $v){     
        $total++;
    }                                                        
    $totalLinks = ceil($total/$perPage);
    $url = $_SERVER['PHP_SELF'];
    $getsearchProducts = $product->getsearchProducts($pages,$perPage,$key);
    $paginateOfSearch = $product->paginateOfSearch($url,$total,$pages,$perPage,1,$key,$_GET['type_prd']);
       
    //}
     ?>

<!-- BREADCRUMB -->

<!-- /BREADCRUMB -->

<!-- SECTION -->
<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">
							<?php foreach($getAllProtypes as $value):
								 ?>
								<div class="input-checkbox">
									
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										<?php echo $value["type_name"] ?>
										<small>(120)</small>
									</label>
								</div>
							
								<?php endforeach; ?>
							</div>
						</div>
						<!-- /aside Widget -->
						
								 
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
							<?php foreach($getAllManus as $value):
								 ?>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
									<?php	echo $value["manu_name"] ?>
										<small>(578)</small>
									</label>
								</div>
								<?php endforeach; ?>	
							</div>
							
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							
							<?php foreach($getTopSellingProducttt as $value): ?>
							<div class="product-widget">
								<div class="product-img">
									<img src="./images/<?php echo $value["image"] ?>" alt="">
								</div>
								<div class="product-body">
									<p class="product-category"></p>
									<h3 class="product-name"><a href="#"><?php echo $value["name"] ?></a></h3>
									<h4 class="product-price"><?php echo number_format($value["price"]) ?></h4>
								</div>
							</div>
								<?php endforeach; ?>
							
						
						</div>
						<!-- /aside Widget -->	
					</div>
					<!-- /ASIDE -->
           
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    <?php						
							foreach ($getsearchProducts as $v):
								foreach($getAllProtypes as $va):
									if($v['type_id'] == $va['type_id']):
                                        foreach($e as $value):
                                            if( $va['type_id'] == $value ):
						?>
                    <!-- product -->
                    <div class="col-md-4 col-xs-6" style="margin-bottom:50px">
                        <div class="product">
                            <div class="product-img">
                                <img src="./images/<?php echo $v['image'] ?>" alt="" style="width:300px; height:150px;;">
                                <div class="product-label">
                                    
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category"><?php echo $va['type_name']?></p>
                                <h3 class="product-name"><a
                                        href="<?php echo 'product.php?id='.$v['id'] ?>"><?php echo substr($v['name'],0,23) ?></a>
                                </h3>
                                <h4 class="product-price">
                                    <?php echo  number_format($v['price'] - $v['price']/100)." ₫";  ?>
                                    <br> <del
                                        class="product-old-price"><?php echo number_format($v['price']) ." ₫";  ?></del>
                                </h4>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <?php $link1 = null; 
                                    if(isset($_SESSION['user']))
                                    {
                                        $link1 = 'wishlist.php?id='.  $v['id']."&&page=result.php"."&&type_prd=".$_GET['type_prd']."&&keyword=".$_GET['keyword'];
                                    } ?>
                                <div class="product-btns">
                                    <button class="add-to-wishlist"><a href="addwishlist.php?id=<?php echo $v["id"];?>"
                                           ><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                                to
                                                wishlist</span></a></button>
                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                            class="tooltipp">add to compare</span></button>
                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                            view</span></button>
                                </div>
                            </div>
                           
                            <div class="add-to-cart">
                                <a href="cart.php?id=<?php echo $v["id"];?>"><button type="submit"
                                        class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                        cart</button></a>
                               
                            </div>
                        </div>
                    </div>
                    <!-- /product -->
                    <?php endif; endforeach; endif; endforeach; endforeach;  ?>
                    <div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>




                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Showing 20-100 products</span>
                    <ul class="store-pagination">
                        <?php if($_GET['pages'] > 1):
                            $prev_page = $_GET['pages'] - 1; ?>
                        <li><a
                                href='result?type_prd=<?php echo $_GET['type_prd'] ?>&&keyword=<?php echo $_GET['keyword'] ?>&&pages=<?php echo $prev_page ?>'><i
                                    class="fa fa-angle-left"></i></a></li>
                        <?php endif; ?>

                        <?php echo $paginateOfSearch; ?>

                        <?php if($_GET['pages'] < $totalLinks - 1):
                                $next_page = $_GET['pages'] + 1 ?>
                        <li><a
                                href='result?type_prd=<?php echo $_GET['type_prd'] ?>&&keyword=<?php echo $_GET['keyword']  ?>&&pages=<?php echo $next_page  ?>'><i
                                    class="fa fa-angle-right"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
            
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php include 'footer.php' ?>
