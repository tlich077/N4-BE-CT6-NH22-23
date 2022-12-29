<?php include "header.php" ?>
<?php include "sidebar.php" ?>
<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$products = new Product();
$getAllProducts = $products->getAllProducts1();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
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
        <div><a class="btn btn-primary btn-sm" href="product-add.php">
            <i class="fas fa-plus">
            </i>
            Add
          </a></div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>
                Image
              </th>
              <th>
                Name
              </th>
              <th>
                Manu_name
              </th>
              <th>
                Type_name
              </th>


              <th>
                Price
              </th>
              <th>
                Description
              </th>
              <th>
                Feature
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $i = 1;
              foreach ($getAllProducts as $value) : ?>
            <tr>
              <td><?php echo $i++ ?></td>
              <td>
                <img style="width:100px" src="../images/<?php echo $value['image']; ?>">
              </td>
              <td><?php echo $value['name']; ?></td>
              <td><?php echo $value['manu_name']; ?></td>
              <td><?php echo $value['type_name']; ?></td>
              <td><?php echo number_format($value ['price']); ?></td>
              <td><?php echo substr($value['description'], 0, 50); ?></td>
              <td><?php echo $value['feature']; ?></td>
              <td class="project-actions text-right" style="display: flex">

                <a class="btn btn-info btn-sm" href="product-edit.php?id=<?php echo $value['id'] ?>">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                </a>
                <a class="btn btn-danger btn-sm" href="product-delete.php?id=<?php echo $value['id']; ?>">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </a>
              </td>

            </tr>

          <?php endforeach; ?>
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
<?php include "footer.php" ?>