<?php   
      include "header.php";
      include "sidebar.php";
      $_SESSION["getID"] = $_GET["id"];
 ?>
<?php
        require "config.php";
        require "models/db.php";
        require "models/user.php";
        $user = new User();
        
    ?>
<?php 
if(isset($_GET['id'])):
  $id=$_GET['id'];
  $getUserById= $user -> getUserById($id);
  foreach($getUserById as $value1):
      if ($value1['id']== $id):
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
              <li class="breadcrumb-item active">User Edit</li>
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
              <h3 class="card-title">User Edit</h3>
            </div>
            <div class="card-body">
           
            <form method="POST" enctype="multipart/form-data" action="handle-edit-user.php">               
                       
               <div class="form-group">
                   <label for="">Fullname</label>
                   <input value="<?php echo $value1['fullname']; ?>" type="text" name="fullname" class="form-control" required>
               </div> 
               <div class="form-group">
                   <label for="">Username</label>
                   <input value="<?php echo $value1['username']; ?>" type="text" name="username" class="form-control" required>
               </div>
               <div class="form-group">
               <label for="">New Password</label>
                   <input type="text" name="password" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="">Retype Password</label>
                   <input type="text" name="retypepassword" class="form-control" required>
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