<?php include "header.php";
      include "sidebar.php";
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
              <li class="breadcrumb-item active">Manufacture Add</li>
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
              <h3 class="card-title">Manufacture Add</h3>
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="handle-add-manufacture.php">
               <div class="form-group">
                   <label for="">Manu_name</label>
                   <input type="text" name="manu_name" class="form-control" required>
               </div>
               <button name="sbm" class="btn btn-success" type="submit">ADD</button>
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