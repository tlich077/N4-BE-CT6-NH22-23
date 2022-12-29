<?php include "header.php";
include "sidebar.php";
 ?>
 <?php
        require "config.php";
        require "models/db.php";
        require "models/protype.php";
        $protype = new Protype();
        $getAllProtypes = $protype -> getAllProtypes();
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Protype</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Protype</li>
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
          <div><a class="btn btn-primary btn-sm" href="protype-add.php">
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
                      type_id
                      </th>
                      <th tyle="width: 35%" >
                      type_name
                      </th>
                  </tr>
              </thead>
              <tbody>
                            <tr>
                                <?php 
                                $type_id = 1; 
                           foreach($getAllProtypes as $value):?>
                            <tr>
                                <td><?php echo $type_id++ ?></td>
                                <td><?php echo $value['type_name']; ?></td>
                                <td class="project-actions text-right" style="display: flex">
                                    <a class="btn btn-info btn-sm" href="protype-edit.php?id=<?php echo $value['type_id'] ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="protype-delete.php?id=<?php echo $value['type_id']; ?>">
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