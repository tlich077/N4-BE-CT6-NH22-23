<?php include "header.php";
include "sidebar.php";
 ?>
 <?php
        require "config.php";
        require "models/db.php";
        require "models/manufacture.php";
        $manu = new Manufacture();
        $getAllManus = $manu -> getAllManus();
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manufacture</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manufacture</li>
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
          <div><a class="btn btn-primary btn-sm" href="manufacture-add.php">
                                        <i class="fas fa-plus">
                                        </i>
                                        Add 
                                    </a></div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 35%" >
                      manu_id
                      </th>
                      <th tyle="width: 35%" >
                      manu_name
                      </th>
                  </tr>
              </thead>
              <tbody>
                            <tr>
                                <?php 
                                $manu_id = 1;
                           foreach($getAllManus as $value):?>
                            <tr>
                                <td><?php echo $manu_id++ ?></td>
                                <td><?php echo $value['manu_name']; ?></td>
                                <td class="project-actions text-right" style="display: flex">
                                    <a class="btn btn-info btn-sm" href="manufacture-edit.php?id=<?php echo $value['manu_id'] ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="manufacture-delete.php?id=<?php echo $value['manu_id']; ?>">
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