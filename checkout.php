<?php 
		
		include "header.php";
	   require "models/infor.php";

	   $info = new Infor;
	   $getInfors = $info -> getInfors();
	  
	   if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$tel = $_POST['tel'];
		$code_order = rand(0,9999);
     
        if (!$firstname || !$lastname || !$address || !$tel)
        {
            echo "<script> alert('Please enter full information') </script>";
        }
        else
        {
			$getInsertInfo = $info -> getInsertInfo($firstname,$lastname,$address,$tel,$code_order);
			//header('location:xemdonhang.php');
			// echo "<script> alert('Dat Hang Thanh Cong')
			//  </script>";
			
			
		}
		

	}

 ?>
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<form action="" method="post">
								<div class="form-group">
									<input class="input" type="text" name="firstname" placeholder="First Name">
								</div>
								<div class="form-group">
									<input class="input" type="text" name="lastname" placeholder="Last Name">
								</div>
								
								<div class="form-group">
									<input class="input" type="text" name="address" placeholder="Address">
								</div>
								
								<div class="form-group">
									<input class="input" type="tel" name="tel" placeholder="Telephone">
								</div>
								<div class="form-group">
									<div class="input-checkbox">
										<input type="checkbox" id="create-account">
										<label for="create-account">
											<span></span>
											Create Account?
										</label>
										<div class="caption">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
											<input class="input" type="password" name="password" placeholder="Enter Your Password">
										</div>
									</div>
								</div>
								<button class="primary-btn order-submit" type="submit" name="submit">Place Order</button> 
							</form>
						
						</div>
						<!-- /Billing Details -->



						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong style="margin-right:-50px">QTY</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<?php if (isset($_SESSION['cart'])) :
									foreach ($_SESSION['cart'] as $key => $value) :
                                    $getProductById1 = $product -> getProductById1($key);
									foreach($getProductById1 as $p):
										?>
							<div class="order-products">
								<div class="order-col">
									<div><?php echo $p["name"] ?></div>
									<div><strong style="margin-right:-60px"><?= $value ?></strong></div>
									<div><?php echo number_format($p["price"]) ?></div>
								</div>
							</div>
							<?php endforeach; endforeach;
										endif; ?>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								
								<div><strong class="order-total"><?php echo number_format($totalPrice)?>VNĐ</strong></div>
							</div>
							
						</div>
						<form action="" method="post">
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<?php 
						?>
						</form>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->


<?php include "footer.php" ?>
