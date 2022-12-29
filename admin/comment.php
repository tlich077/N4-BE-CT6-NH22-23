<?php include "header.php";
include "sidebar.php";
 ?>
 <?php
        require "config.php";
        require "models/db.php";
        require "models/comment.php";
        $cmt = new Comment();
        $getComments = $cmt -> getComments();
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Review List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Review List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 35%" >
                      id
                      </th>
                      <th tyle="width: 35%" >
                      Name
                      </th>
                      <th tyle="width: 35%" >
                      Email
                      </th>
                      <th tyle="width: 35%" >
                      Date
                      </th>
                      <th tyle="width: 35%" >
                      Review
                      </th>
                      <th tyle="width: 35%" >
                      Rate
                      </th>
                      <th tyle="width: 35%" >
                      Product_id
                      </th>
                    
                  </tr>
              </thead>
              <tbody>
                            <tr>
                                <?php 
                                $id_cmt = 1; 
                           foreach($getComments as $value):?>
                            <tr>
                                <td><?php echo $id_cmt++ ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['ngay_cmt']; ?></td>
                                <td><?php echo $value['review']; ?></td>
                                <td><?php echo $value['star']; ?></td>
                                <td><?php echo $value['id'] ?></td>

                                
                            </tr>
                            <?php endforeach;?>
                            </tr>
                        </tbody>

          </table>
        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include "footer.php"; ?>