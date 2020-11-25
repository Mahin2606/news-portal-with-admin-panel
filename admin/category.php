<?php include "inc/header.php"; ?>

  <!-- Navbar -->
  <?php include "inc/topbar.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "inc/menu.php"; ?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage All Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left Side -->
          <div class="col-lg-5">
            <!-- Add New Category Start -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Category</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: block;">
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" autocomplete="off" required="required" id="name">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc" rows="7"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Primary Category (Please select one if this is a sub-category)</label>
                    <select class="form-control" name="is_parent">
                      <option value="">Select the Primary Category</option>
                      <?php
                        $sqlAdd = "SELECT * FROM category WHERE is_parent = 0";
                        $readPriCat = mysqli_query($db, $sqlAdd);
                        while ($row = mysqli_fetch_assoc($readPriCat)) {
                          $priCat_id = $row['cat_id'];
                          $priCat_name = $row['cat_name'];
                          ?>
                          <option value="<?php echo $priCat_id; ?>"><?php echo $priCat_name; ?></option>
                        <?php }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select required class="form-control" name="status">
                      <option value="">Please Select the Category Status</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group text-center">
                    <input type="submit" name="addCategory" class="btn btn-block btn-primary btn-flat" value="Add New Category">
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- Add New Category End -->

            <?php
              // Register New Category
              if ( isset($_POST['addCategory']) ){
                $name       = $_POST['name'];
                $desc       = mysqli_real_escape_string($db, $_POST['desc']);
                $is_parent  = $_POST['is_parent'];
                $status     = $_POST['status'];

                $sql = "INSERT INTO category (cat_name, cat_desc, is_parent, status) VALUES ('$name', '$desc', '$is_parent', '$status')";

                $AddSuccess = mysqli_query($db, $sql);

                if ( $AddSuccess ){
                  $_SESSION['message'] = 'New Category Added Successfully!';
                  header("Location: category.php");
                  exit();
                }
                else{
                  $_SESSION['message'] = 'Required Data Input Missing!';
                  die("MySQL Connection Faild." . mysqli_error($db));
                }
              }
            ?>
          </div>

          <!-- Right Side -->
          <div class="col-lg-7">
            <!-- Edit Form Start -->
            <?php
              if (isset( $_GET['edit'] )){ 
                $editID = $_GET['edit'];
                
                $sql = "SELECT * FROM category WHERE cat_id = '$editID'";
                $editCat = mysqli_query($db, $sql);
                while ( $row = mysqli_fetch_assoc($editCat) ) {
                  $cat_id       = $row['cat_id'];
                  $cat_name     = $row['cat_name'];
                  $cat_desc     = $row['cat_desc']; 
                  $is_parent    = $row['is_parent'];
                  $status       = $row['status'];
                  ?>

                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Update Category Information</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body" style="display: block;">
                      <form action="" method="POST">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" autocomplete="off" required="required" id="name" value="<?php echo $cat_name; ?>">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="desc"><?php echo $cat_desc; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Primary Category (Please select one if this is a sub-category)</label>
                          <select class="form-control" name="is_parent">
                            <option value="">Select the Primary Category</option>
                            <?php
                              $queryEdit = "SELECT * FROM category WHERE is_parent = 0";
                              $readPrimaryCategory = mysqli_query($db, $queryEdit);
                              while ($row = mysqli_fetch_assoc($readPrimaryCategory)) {
                                $priCat_id = $row['cat_id'];
                                $priCat_name = $row['cat_name'];

                                if ($priCat_id == $is_parent) { ?>
                                  <option value="<?php echo $priCat_id; ?>" selected><?php echo $priCat_name; ?></option>
                                <?php }
                                else if ($priCat_id == $cat_id) { ?>
                                  <option value="0" selected><?php echo $priCat_name; ?></option>
                                <?php }
                                else { ?>
                                  <option value="<?php echo $priCat_id; ?>"><?php echo $priCat_name; ?></option>
                                <?php }
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="1">Please Select the Category Status</option>
                            <option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?> >Active</option>
                            <option value="0" <?php if ( $status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="updateID" value="<?php echo $cat_id; ?>">
                          <input type="submit" name="updateCategory" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                        </div>
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
              <?php  }                
              }
            ?>

            <?php
              // Update Category Info
              if (isset($_POST['updateCategory'])){
                $name       = $_POST['name'];
                $desc       = mysqli_real_escape_string($db, $_POST['desc']);
                $is_parent  = $_POST['is_parent'];
                $status     = $_POST['status'];
                $updateID   = $_POST['updateID'];

                $sql = "UPDATE category SET cat_name='$name', cat_desc='$desc', is_parent='$is_parent', status='$status' WHERE cat_id = '$updateID'";

                $updateSuccess = mysqli_query($db, $sql);

                if ( $updateSuccess ){
                  $_SESSION['message'] = 'Category Updated Successfully!';
                  header("Location: category.php");
                  exit();
                }
                else{
                  die("MySQL Connection Faild." . mysqli_error($db));
                }
              }
            ?>
            <!-- Edit Form End -->

            <!-- All Category Start -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage All Category</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0" style="display: block;">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 20%">
                            #SL.
                        </th>
                        <th style="width: 20%">
                            Category Name
                        </th>
                        <th style="width: 20%">
                            Primary Category
                        </th>
                        <th style="width: 20%">
                            Status
                        </th>                           
                        <th style="width: 20%">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "SELECT * FROM category";
                        $allCat = mysqli_query($db, $sql);
                        $i = 0;
                        while ( $row = mysqli_fetch_assoc($allCat) ) {
                          $cat_id       = $row['cat_id'];
                          $cat_name     = $row['cat_name'];
                          $cat_desc     = $row['cat_desc'];
                          $is_parent    = $row['is_parent'];
                          $status       = $row['status'];
                          $i++;
                          ?>

                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $cat_name; ?></td>
                            <td>
                              <?php
                                if ( $is_parent == 0) { ?>
                                  <span class="badge badge-primary ">Base Category</span>
                                <?php }
                                else {
                                  $query = "SELECT * FROM category WHERE cat_id = '$is_parent'";
                                  $readPriCat = mysqli_query($db, $query);
                                  while ($row = mysqli_fetch_assoc($readPriCat)) {
                                    $priCat_id = $row['cat_id'];
                                    $priCat_name = $row['cat_name'];
                                    ?>
                                    <span class="badge badge-info"><?php echo $priCat_name; ?></span>
                                  <?php }
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                                if ( $status == 0 ){ ?>
                                  <span class="badge badge-warning">Inactive</span>
                                <?php }
                                else if ( $status == 1 ){ ?>
                                  <span class="badge badge-success">Active</span>
                                <?php }
                              ?>
                            </td>
                            <td>
                              <a class="btn btn-info btn-sm" href="category.php?edit=<?php echo $cat_id; ?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                              </a>
                              <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>">
                                <i class="fas fa-trash">
                                </i>
                              </a>
                            </td>
                          </tr>

                          <!-- Delete Modal -->
                          <div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this category?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="delete-option text-center">
                                    <ul>
                                      <li><a href="category.php?delete=<?php echo $cat_id; ?>" class="btn btn-danger">Delete</a></li>
                                      <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        <?php  }
                        ?>
                        
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- All Category End -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    // Delete Category Query
    if ( isset( $_GET['delete'] ) ){
      $delete_id = $_GET['delete'];

      $sql = "DELETE FROM category WHERE cat_id = '$delete_id' ";
      $delete_query = mysqli_query($db, $sql);
      if ( $delete_query ){
        $_SESSION['message'] = 'Category Deleted Successfully!';
        header("Location: category.php");
        exit();
      }
      else{
        $_SESSION['message'] = 'Required Data Input Missing!';
        die("MySQL Query Failed. " . mysqli_error($db));
      }
    }
  ?>


  <!-- Footer -->
  <?php include "inc/footer.php"; ?>

  <!-- Control Sidebar -->
  <?php include "inc/sidebar.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>