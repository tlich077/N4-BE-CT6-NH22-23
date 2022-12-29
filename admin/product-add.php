<?php include "header.php";
      include "sidebar.php";
 ?>
<?php

        require "config.php";
        require "models/db.php";
        require "models/product.php";
        require "models/protype.php";
        require "models/manufacture.php";
        
        $manufactures = new Manufacture();
        $products = new Product();
        $protypes = new Protype();
        $getAllProducts = $products -> getAllProducts1();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Product Add</h3>


            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="handle-add-product.php">
               
               <div class="form-group">
                   <label for="">Name</label>
                   <input type="text" name="name" class="form-control" required>
               </div>

               <div class="form-group">
                   <label for="">Type_name</label>
                   <select name="type_name" id="" >
                    <option selected disable>Select me</option  >
                    <?php
                    $getAllProtypes = $protypes -> getAllProtypes();
                    foreach ($getAllProtypes as $value):

                    ?>
                    <option value="<?php echo $value["type_id"] ?>"><?php echo $value["type_name"] ?></option>
                    <?php endforeach; ?>
                   </select>
               </div>
               <div class="form-group">
                   <label for="">Manu_name</label>
                   <select name="manu_name" id="" >
                    <option selected disable>Select me</option  >
                    <?php
                    $getAllManus = $manufactures -> getAllManus();
                    foreach ($getAllManus as $value):

                    ?>
                    <option value="<?php echo $value["manu_id"] ?>"><?php echo $value["manu_name"] ?></option>
                    <?php endforeach; ?>
                   </select>
               </div>
                
               <div class="form-group">
                   <label for="">price</label>
                   <input type="number" name="price" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="">image</label>
                   <input type="file" name="image" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="">description</label>
                   <textarea name="description" id="" cols="160" rows="8" required></textarea>
               </div>
               <div class="form-group">
                   <label for="">feature</label>
                   <input type="checkbox" name="feature" class="form-control" >
               </div>

               <div class="form-group">
                   <label for="">bestseller</label>
                   <input type="text" name="bestseller" class="form-control" required>
               </div>
               <input type="submit" value="Create new Porject" class="btn btn-success float-right">
           </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
     
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include "footer.php"; ?>