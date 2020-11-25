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
            <h1 class="m-0 text-dark">Manage Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Profile</li>
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
                <h3 class="card-title">Your Profile</h3>
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
                  $user_id = $_SESSION['id'];
                  $query = "SELECT * FROM users WHERE id = '$user_id'";
                  $theUser = mysqli_query($db, $query);
                  while( $row = mysqli_fetch_assoc($theUser) ) {
                      $id         = $row['id'];
                      $name       = $row['name'];
                      $email      = $row['email'];
                      $password   = $row['password'];
                      $address    = $row['address'];
                      $phone      = $row['phone'];
                      $role       = $row['role'];
                      $status     = $row['status'];
                      $image      = $row['image'];
                      $join_date  = $row['join_date'];
                  }
                ?>
                <img src="img/users/<?php echo $image; ?>" class="img-fluid">
                <table class="table table-striped" style="margin-top: 10px;">
                  <tbody>
                    <tr>
                      <th scope="col">Full Name</th>
                      <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Email Address</th>
                      <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Phone No</th>
                      <td><?php echo $phone; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Address</th>
                      <td><?php echo $address; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">User Role</th>
                      <td>
                        <?php
                          if ($role == 1) { ?>
                            <span class="badge badge-success">Admin</span>
                          <?php }
                          else if ($role == 2) { ?>
                            <span class="badge badge-primary">Editor</span>
                          <?php }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Join Date</th>
                      <td><?php echo $join_date; ?></td>
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
                <h3 class="card-title">Update Your Profile</h3>
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
                  $user_id = $_SESSION['id'];
                  $query = "SELECT * FROM users WHERE id = '$user_id'";
                  $theUser = mysqli_query($db, $query);
                  while( $row = mysqli_fetch_assoc($theUser) ) {
                      $id         = $row['id'];
                      $name       = $row['name'];
                      $email      = $row['email'];
                      $password   = $row['password'];
                      $address    = $row['address'];
                      $phone      = $row['phone'];
                      $image      = $row['image'];
                      ?>

                      <div class="row">
                        <div class="col-lg-6">
                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input type="text" name="name" class="form-control" required="required" value="<?php echo $name; ?>">
                            </div>

                            <div class="form-group">
                              <label>Email Address</label>
                              <input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>" readonly="readonly">
                            </div>

                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="password" class="form-control" placeholder="Change The Password">
                            </div>

                            <div class="form-group">
                              <label>Retype Password</label>
                              <input type="password" name="repassword" class="form-control" placeholder="Retype The Password">
                            </div>

                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                              <label>Phone No.</label>
                              <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                            </div>

                            <div class="form-group">
                              <label>Upload Image</label>
                              <?php
                                if ( !empty($image) ){ ?>
                                  <img src="img/users/<?php echo $image; ?>" class="user-profile-img">
                                <?php }
                                else{
                                  echo "No Image uploaded";
                                }
                              ?>
                              <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group text-center">
                              <input type="hidden" name="updateUserProfileID" value="<?php echo $id; ?>">
                              <input type="submit" name="updateUserProfile" class="btn btn-success btn-flat" value="Save Changes" style="margin-top: 20px;">
                            </div>
                          </form>
                        </div>
                      </div>

                  <?php }
                ?>
              </div>
              <!-- /.card-body -->

              <?php
                if ( isset($_POST['updateUserProfile']) ){
                  $updateUserID = $_POST['updateUserProfileID'];
                  $name         = $_POST['name'];
                  $email        = $_POST['email'];
                  $password     = $_POST['password'];
                  $repassword   = $_POST['repassword'];
                  $address      = $_POST['address'];
                  $phone        = $_POST['phone'];
                  $imageName    = basename($_FILES['image']['name']);

                  $formErrors = array();

                  if ( strlen($name) < 4 ){
                    array_push($formErrors, 'Username is too short!');
                  }
                  if ( $password != $repassword ){
                    array_push($formErrors, 'Passwords Doesn\'t match!');
                  }

                  if ( !empty($imageName) ){
                    // Preapre the Image
                    $imageSize    = $_FILES['image']['size'];
                    $imageTmp     = $_FILES['image']['tmp_name'];

                    $imageFileType = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));

                    if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ){
                      array_push($formErrors, 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image');
                    }
                    if ( !empty($imageSize) && $imageSize > 2097152 ){
                      array_push($formErrors, 'Image Size is Too Large! Allowed Image size Max is 2 MB.');
                    }
                  }

                  if ( empty($formErrors) ){
                    // Upload Image and Change the Password
                    if ( !empty($password) && !empty($imageName) ){
                      // Encrypted Password
                      $hassedPass = sha1($password);

                      // Delete the Existing Image while update the new image
                      $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                      $data = mysqli_query($db, $deleteImageSQL);
                      while( $row = mysqli_fetch_assoc($data) ){
                        $existingImage = $row['image'];
                      }
                      unlink('img/users/'. $existingImage);
                       
                      // Change the Image Name
                      $image = rand(0, 999999) . '_' .$imageName;
                      // Upload the Image to its own Folder Location
                      move_uploaded_file($imageTmp, "img\users\\" . $image );

                      $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', image='$image' WHERE id = '$updateUserID' ";

                      $addUser = mysqli_query($db, $sql);

                      if ( $addUser ){
                        $_SESSION['message'] = 'User Information Updated Successfully!';
                        header("Location: profile.php");
                        exit();
                      }
                      else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                      }
                    }
                    // Change the Image Only
                    else if ( !empty($imageName) && empty($password) ){
                      // Delete the Existing Image while update the new image
                      $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                      $data = mysqli_query($db, $deleteImageSQL);
                      while( $row = mysqli_fetch_assoc($data) ){
                        $existingImage = $row['image'];
                      }
                      unlink('img/users/'. $existingImage);
                       
                      // Change the Image Name
                      $image = rand(0, 999999) . '_' .$imageName;
                      // Upload the Image to its own Folder Location
                      move_uploaded_file($imageTmp, "img\users\\" . $image );

                      $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', image='$image' WHERE id = '$updateUserID' ";

                      $addUser = mysqli_query($db, $sql);

                      if ( $addUser ){
                        $_SESSION['message'] = 'User Information Updated Successfully!';
                        header("Location: profile.php");
                        exit();
                      }
                      else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                      }
                    }
                    // Change the Password Only
                    else if ( !empty($password) && empty($imageName) ){
                      // Encrypted Password
                      $hassedPass = sha1($password);

                      $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone' WHERE id = '$updateUserID' ";

                      $addUser = mysqli_query($db, $sql);

                      if ( $addUser ){
                        $_SESSION['message'] = 'User Information Updated Successfully!';
                        header("Location: profile.php");
                        exit();
                      }
                      else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                      }
                    }
                    // No Password and Image Update
                    else{
                      $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone' WHERE id = '$updateUserID' ";

                      $addUser = mysqli_query($db, $sql);

                      if ( $addUser ){
                        $_SESSION['message'] = 'User Information Updated Successfully!';
                        header("Location: profile.php");
                        exit();
                      }
                      else{
                        die("MySQLi Query Failed." . mysqli_error($db));
                      }
                    }
                  }
                  else {
                    // Print the Errors 
                    foreach( $formErrors as $key => $error ){
                      echo '<div class="alert alert-danger"><h5>' . $error . '</h5></div>';
                    }
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