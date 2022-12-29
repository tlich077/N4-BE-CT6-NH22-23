<?php include "header.php";
include "sidebar.php";
 ?>
 <?php
        require "config.php";
        require "models/db.php";
        require "models/user.php";
        $user = new User();
        $getUser = $user -> getUser();
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div><a class="btn btn-primary btn-sm" href="user-add.php">
                                        <i class="fas fa-plus">
                                        </i>
                                        Add 
                                    </a></div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 20%" >
                      Stt
                      </th>
                      <th style="width: 30%" >
                      Fullname
                      </th>
                      <th tyle="width: 35%" >
                      Username
                      </th>
                  </tr>
              </thead>
              <tbody>
                            <tr>
                                <?php 
                                $id = 1;
                           foreach($getUser as $value):?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $value['fullname']; ?></td>
                                <td><?php echo $value['username']; ?></td>
                                <td class="project-actions text-right" style="display: flex">
                                    <a class="btn btn-info btn-sm" href="user-edit.php?id=<?php echo $value['id'] ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="user-delete.php?id=<?php echo $value['id']; ?>">
                                        <i class="fas fa-trash">
                                        </i>
                                    Delete
                                    </a>
                                </td>
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