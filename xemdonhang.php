<?php

include "header.php";
include "models/infor.php";
$info = new Infor;
$getInfors = $info->getInfors();


?>

<link rel="stylesheet" type="css/viewcart.css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container-fuild bootstrap snippets bootdey">
    <div class="col-md-12 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <h3 style="margin-top:15px">SẢN PHẨM ĐÃ MUA</h3>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">

                            <tbody>
                                <?php if (isset($_SESSION['cart'])) :
                                    foreach ($_SESSION['cart'] as $key => $value) :
                                        $getProductById1 = $product->getProductById1($key);
                                        foreach ($getProductById1 as $p) :
                                ?>
                                            <tr>
                                                
                                                <td><img src="./images/<?php echo $p['image'] ?>" width="15%" class="img-cart"></td>
                                                <td><strong><?php echo $p["name"] ?></strong></td>
                                                <td>
                                                    <p class="qty"><?php echo $value ?></p>
                                                </td>
                                                <td><?php echo number_format($p["price"]) ?></td>
                                                <td><?php echo number_format($p["price"] * $value) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">&nbsp;</td>
                                            </tr>
                                <?php endforeach;
                                    endforeach;
                                endif; ?>

                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                    <td><?php echo number_format($totalPrice) ?> VNĐ</td>

                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>






<?php
include "footer.php"
?>