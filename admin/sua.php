<?php
   require "config.php";
   require "models/db.php";
   require "models/product.php";
   $products = new Product;
?>
<?php
    $id=0;
    if(isset($_GET['id'])):
        $id=$_GET['id'];
        $getThongTinSP= $products -> getThongTinSP($id);
        foreach($getThongTinSP as $value):
            if ($value['id']==$id):
               
            
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>EDIT PRODUCT</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="">Ten san pham</label>
                        <input type="text" name="name" value="<?php echo $value['name']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">manu_id</label>
                        <input type="text" name="manu_id" value="<?php echo $value['manu_id']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">type_id</label>
                        <input type="text" name="type_id" value="<?php echo $value['type_id']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">price</label>
                        <input type="number" name="price" value="<?php echo $value['price']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">image</label>
                        <input type="file" name="image" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="">description</label>
                        <input type="text" name="description" value="<?php echo $value['description']; ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">feature</label>
                        <input type="text" name="feature" value="<?php echo $value['feature']; ?>" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="">bestseller</label>
                        <input type="text" name="bestseller" value="<?php echo $value['bestseller']; ?>" class="form-control">
                    </div>
                    <button name="sbm" class="btn btn-success" type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php endif; endforeach; endif; 
if (isset($_POST['sbm'])) {
    $name = $_POST['name'];
    $manu_id = $_POST['manu_id'];
    $type_id = $_POST['type_id'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $description = $_POST['description'];
    $feature = $_POST['feature'];
    $bestseller = $_POST['bestseller'];
    $sua = $products -> sua($id, $name,  $manu_id, $type_id,$price,$image, $description,$feature,$bestseller);
    move_uploaded_file($image_tmp,'images'.$image);
    header('location:index.php?page_layout=danhsach');
}
?>