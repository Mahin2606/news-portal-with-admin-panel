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
            <h1 class="m-0 text-dark">Manage Contact Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage Contact Information</li>
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
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contact Information</h3>
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
                <?php
                  $query = "SELECT * FROM contacts";
                  $readContacts = mysqli_query($db, $query);
                  while( $row = mysqli_fetch_assoc($readContacts) ) {
                      $id         = $row['id'];
                      $address    = $row['address'];
                      $email      = $row['email'];
                      $phone_one  = $row['p_one'];
                      $phone_two  = $row['p_two'];
                      $off_time   = $row['office_time'];
                  }
                ?>
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th scope="col">Address</th>
                      <td><?php echo $address; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Official Email Address</th>
                      <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Telephone No</th>
                      <td><?php echo $phone_one; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Mobile No</th>
                      <td><?php echo $phone_two; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Office Time</th>
                      <td><?php echo $off_time; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Contact Information</h3>
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
                <?php
                  $query = "SELECT * FROM contacts";
                  $readContacts = mysqli_query($db, $query);
                  while( $row = mysqli_fetch_assoc($readContacts) ) {
                      $id           = $row['id'];
                      $address      = $row['address'];
                      $email        = $row['email'];
                      $p_one        = $row['p_one'];
                      $p_two        = $row['p_two'];
                      $office_time  = $row['office_time'];
                      ?>

                      <div class="row">
                        <div class="col-lg-12">
                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Office Address</label>
                              <input type="text" name="address" class="form-control" required="required" value="<?php echo $address; ?>">
                            </div>

                            <div class="form-group">
                              <label>Official Email Address</label>
                              <input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>">
                            </div>

                            <div class="form-group">
                              <label>Telephone No</label>
                              <input type="text" name="p_one" class="form-control" required="required" value="<?php echo $p_one; ?>">
                            </div>

                            <div class="form-group">
                              <label>Mobile No</label>
                              <input type="text" name="p_two" class="form-control" required="required" value="<?php echo $p_two; ?>">
                            </div>

                            <div class="form-group">
                              <label>Office Time</label>
                              <input type="text" name="office_time" class="form-control" value="<?php echo $office_time; ?>">
                            </div>

                            <div class="form-group text-center">
                              <input type="hidden" name="updateContactsID" value="<?php echo $id; ?>">
                              <input type="submit" name="updateContacts" class="btn btn-success btn-flat" value="Save Changes" style="margin-top: 10px;">
                            </div>
                          </form>
                        </div>
                      </div>

                  <?php }
                ?>
              </div>
              <!-- /.card-body -->

              <?php
                if ( isset($_POST['updateContacts']) ) {
                  $updateContactsID = $_POST['updateContactsID'];
                  $address          = $_POST['address'];
                  $email            = $_POST['email'];
                  $p_one            = $_POST['p_one'];
                  $p_two            = $_POST['p_two'];
                  $off_time         = $_POST['office_time'];

                  $sql = "UPDATE contacts SET address='$address', email='$email', p_one='$p_one', p_two='$p_two', office_time='$off_time' WHERE id = '$updateContactsID'";

                  $updateSuccess = mysqli_query($db, $sql);

                  if ( $updateSuccess ){
                    $_SESSION['message'] = 'Contact Information Updated Successfully!';
                    header("Location: contactInfo.php");
                    exit();
                  }
                  else{
                    die("MySQL Connection Faild." . mysqli_error($db));
                  }
                } 
              ?>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Footer -->
  <?php include "inc/footer.php"; ?>

  <!-- Control Sidebar -->
  <?php include "inc/sidebar.php"; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "inc/script.php"; ?>