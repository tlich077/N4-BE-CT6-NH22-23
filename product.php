<?php include "header.php";
		include "models/comment.php";
		$comment = new Comment();
?>

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							
						<li class="active"><a href="#">Home</a></li>
                    <?php foreach ($getAllProtypes as $value) : ?>
                    <li><a href="#"><?= $value['type_name'] ?></a></li>
                    <?php endforeach; ?>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
<?php
$type_id;
$manu_id;
if (isset($_GET['id'])):
	$id = $_GET['id'];
	$getCommentID = $comment->getCommentId($id);
	$count_comment = count($getCommentID);
	foreach ($getAllProducts as $value):
		if ($id == $value['id']):
			$type_id = $value['type_id'];
			$manu_id = $value['manu_id'];
?>
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<?php
					if(isset($_GET['id'])):
						$id = $_GET['id'];
					$getProductById = $product -> getProductById($id);
						foreach($getProductById as $value):
							if($id == $value["id"]):
					 ?>
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="./images/<?php echo $value['image'] ?>" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->
					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								
								<img src="./images/<?php echo $value['image'] ?>" alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $value["name"]?></h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price">$<?php echo number_format($value["price"])?><del class="product-old-price"></del></h3>
								<span class="product-available">In Stock</span>
							</div>
							<p><?php echo substr($value['description'],0,200)?></p>

							<div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn"> <a
                                                href="cart.php?id=<?php echo $value["id"];?>"><i
                                                    class="fa fa-shopping-cart"></i>add to
                                                cart</a></button>
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">Headphones</a></li>
								<li><a href="#">Accessories</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<?php endif; endforeach;endif; ?>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p><?php echo $value['description']?></p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p><?php echo $value['description']?></p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
										<!-- tab3  -->
										<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div class="col-md-3">
									<div id="rating">
										<div class="rating-avg">
											<?php
			$star = array();
			$star[1] = 0;
			$star[2] = 0;
			$star[3] = 0;
			$star[4] = 0;
			$star[5] = 0; foreach ($getCommentID as $review) {
				switch ($review["star"]) {
					case '1':
						$star[1]++;
						break;
					case '2':
						$star[2]++;
						break;
					case '3':
						$star[3]++;
						break;
					case '4':
						$star[4]++;
						break;
					case '5':
						$star[5]++;
						break;

					default:
						# code...
						break;
				}
			}
			$avg_star = 0;
			foreach ($getCommentID as $key) {
				$avg_star += $key["star"];
			}
			$avg_star = $count_comment > 0 ? $avg_star / $count_comment : 0;
                                            ?>
											<span><?php echo $avg_star ?></span>
											<div class="rating-stars">
												<?php
			for ($i = 0; $i < $avg_star; $i++) {
				echo "<i class=\"fa fa-star\"></i>";
			}
			for ($i = 0; $i < 5 - $avg_star; $i++) {
				echo "<i class=\"fa fa-star-o\"></i>";
			}
                                                ?>
											</div>
										</div>
										<ul class="rating">
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="rating-progress">
													<div
														style="width: <?php echo $count_comment * 100 > 0 ? $star[5] / $count_comment * 100 : 0 ?>%;">
													</div>
												</div>
												<span class="sum"><?php echo $star[5]; ?></span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div
														style="width: <?php echo $count_comment * 100 > 0 ? $star[4] / $count_comment * 100 : 0 ?>%;">
													</div>
												</div>
												<span class="sum"><?php echo $star[4]; ?></span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div
														style="width: <?php echo $count_comment * 100 > 0 ? $star[3] / $count_comment * 100 : 0 ?>%;">
													</div>
												</div>
												<span class="sum"><?php echo $star[3]; ?></span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div
														style="width: <?php echo ($count_comment > 0 ? $star[2] / $count_comment : 0) * 100 ?>%;">
													</div>
												</div>
												<span class="sum"><?php echo $star[2]; ?></span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div
														style="width: <?php echo ($count_comment > 0 ? $star[1] / $count_comment : 0) * 100 ?>%;">
													</div>
												</div>
												<span class="sum"><?php echo $star[1]; ?></span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
										<?php foreach ($getCommentID as $review):?>
											<li>
												<div class="review-heading">
													<h5 class="name"><?php echo $review['name']?></h5>
													<p class="date"><?php echo $review['ngay_cmt']?></p>
													<div class="review-rating">
														<?php 
														for ($i = 0; $i < $review['star']; $i++) {
															echo "<i class=\"fa fa-star\"></i>";
														}
														for ($i = 0; $i < 5 - $review['star']; $i++) {
															echo "<i class=\"fa fa-star-o\"></i>";
														}
														?>
													</div>
												</div>
												<div class="review-body">
													<p><?php echo $review['review']?></p>
												</div>
											</li>	
											<?php endforeach;?>										
										</ul>
										<ul class="reviews-pagination">
											<li class="active">1</li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<form class="review-form" action="handle-comment.php" method="post">
											<input class="input" type="text" placeholder="Your Name" name="name">
											<input class="input" type="email" placeholder="Your Email" name="email">
											<textarea class="input" placeholder="Your Review" name="review"></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="star" value="5" type="radio"><label
														for="star5"></label>
													<input id="star4" name="star" value="4" type="radio"><label
														for="star4"></label>
													<input id="star3" name="star" value="3" type="radio"><label
														for="star3"></label>
													<input id="star2" name="star" value="2" type="radio"><label
														for="star2"></label>
													<input id="star1" name="star" value="1" type="radio"><label
														for="star1"></label>
												</div>
											</div>
											<input type="text" name="id" value="<?php echo $id ?>" hidden>
											<button class="primary-btn">Submit</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<?php endif; endforeach; endif; ?>
		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
						
					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>
					<?php if (isset($_GET['id'])) :
					$id = $_GET['id'];
			
					foreach ($getAllProducts as $value) :
						if ($id == $value['id']) :
							$type_id = $value['type_id'];
							$getProductByIdType = $product->getProductByIdType($type_id);
							foreach ($getProductByIdType as $value1) :
				?>
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="./images/<?php echo $value1["image"]?>" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category"></p>
								<h3 class="product-name"><a href="#"><?php echo $value1["name"]?></a></h3>
								<h4 class="product-price"><?php echo number_format($value1["price"])?></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->
					<?php
							endforeach;
						endif;
					endforeach;
				endif;
				?>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
<?php include "footer.php"; ?>