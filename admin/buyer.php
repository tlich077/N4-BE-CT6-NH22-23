<?php include "header.php";
include "sidebar.php";
 ?>
 <?php
        require "config.php";
        require "models/db.php";
        require "models/infor.php";
        $infor = new Infor();
        $getInfors = $infor -> getInfors();
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order List</li>
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
                      FirstName
                      </th>
                      <th tyle="width: 35%" >
                      LastName
                      </th>
                      <th tyle="width: 35%" >
                      Address
                      </th>
                      <th tyle="width: 35%" >
                      Telephone
                      </th>
                      <th tyle="width: 35%" >
                      Code_order
                      </th>
                  </tr>
              </thead>
              <tbody>
                            <tr>
                                <?php 
                                $id = 1; 
                           foreach($getInfors as $value):?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $value['fname']; ?></td>
                                <td><?php echo $value['lname']; ?></td>
                                <td><?php echo $value['address']; ?></td>
                                <td><?php echo $value['tel']; ?></td>
                                <td><?php echo $value['code_order']; ?></td>
                                
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