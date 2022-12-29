<?php
include "header.php"
?>

<link rel="stylesheet" type="css/viewcart.css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container-fuild bootstrap snippets bootdey">
    <div class="col-md-12 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <?php
                    if (isset($_SESSION['username'])):
                     ?>
                    <div class="panel-heading" style="background-color: #CCFFFF">
                        <h3>
                            <img class="img-circle img-thumbnail" src="https://bootdey.com/img/Content/user_3.jpg" width="10%"> <span>
                            <p><?php echo $_SESSION['username'] ?></p>   
                            </span>                               
                        </h3>
                    </div>
                    <?php endif; ?>
                    <div class="panel-body"> 
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($_SESSION['cart'])) :
											foreach ($_SESSION['cart'] as $key => $value) :
                                                $getProductById1 = $product -> getProductById1($key);
												foreach($getProductById1 as $p):

										?>
                                <tr>
                                    <td><img src="./images/<?php echo $p['image'] ?>" width="30%" class="img-cart"></td>
                                    <td><strong><?php echo $p["name"] ?></strong></td>
                                    <td>
                                    <form class="form-inline">
                                        <p class="qty"><?php echo $value ?></p>
                                        <button rel="tooltip" class="btn btn-default"><i class="fa fa-pencil"><?php  ?></i></button>
                                        <a href="delvc.php?id=<?php echo $key ?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                                    </form>
                                    </td>
                                    <td><?php echo number_format($p["price"]) ?></td>
                                    <td><?php echo number_format($p["price"]* $value)?></td>
                                </tr>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                              
                                <?php endforeach; endforeach;
										endif; ?>
                              
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                    <td><?php echo number_format($totalPrice)?> VNĐ</td>
                                    <th> <a href="delvc.php"><i class="fa fa-trash-o" style="font-weight: bold;">ALL</a></th>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                </div>
                <a href="index.php" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Continue Shopping</a>
                <a href="checkout.php?id=" class="btn btn-primary pull-right">Next<span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>



<?php
include "footer.php"
 ?>