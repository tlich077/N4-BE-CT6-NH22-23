<?php   
      include "header.php";
      include "sidebar.php";
      $_SESSION["getID"] = $_GET["id"];
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
        $getAllProtype = $protypes -> getAllProtypes(); 
    ?>
<?php 
if(isset($_GET['id'])):
  $id=$_GET['id'];
  $getThongTinSP= $protypes -> getThongTinSP($id);
  foreach($getThongTinSP as $value1):
      if ($value1['type_id']== $id):
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
              <li class="breadcrumb-item active">Product Edit</li>
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
              <h3 class="card-title">Protype Edit</h3>
            </div>
            <div class="card-body">
           
            <form method="POST" enctype="multipart/form-data" action="handle-edit-protype.php">               
                       
               <div class="form-group">
                   <label for="">Type_name</label>
                   <input value="<?php echo $value1['type_name']; ?>" type="text" name="type_name" class="form-control" required>
               </div>       
               <input type="submit" value="Edit" class="btn btn-success float-right">
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

<?php
  endif;endforeach;endif;
include "footer.php"; ?>