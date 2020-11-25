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
            <h1 class="m-0 text-dark">Manage All Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Post</li>
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
          <?php
            // CRUD operations for post
            $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

            if ( $do == 'Manage' ){ ?>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Manage All Posts</h3>
                  </div>
                  <div class="card-body" style="display: block;">
                    
                    <table id="allRecords" class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#Sl.</th>
                          <th scope="col">Image</th>
                          <th scope="col">Title</th>
                          <th scope="col">Category</th>
                          <th scope="col">Author</th>
                          <th scope="col">Status</th>
                          <th scope="col">Post Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                          $sql = "SELECT * FROM post ORDER BY post_id DESC";
                          $allPost = mysqli_query($db, $sql);
                          $i = 0;
                          while( $row = mysqli_fetch_assoc($allPost) ){
                            $post_id      = $row['post_id'];
                            $title        = $row['title'];
                            $description  = $row['description'];
                            $image        = $row['image'];
                            $category_id  = $row['category_id'];
                            $author_id    = $row['author_id'];
                            $status       = $row['status'];
                            $meta         = $row['meta'];
                            $post_date    = date("d-m-Y h:i", strtotime($row['post_date']));
                            $i++;
                            ?>

                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td>
                                <?php
                                  if (!empty($image)) { ?>
                                    <img src="img/post/<?php echo $image; ?>" class="table-img">
                                  <?php }
                                  else{ ?>
                                    <img src="img/post/default.png" class="table-img">
                                  <?php }
                                ?>
                              </td>
                              <td><?php echo $title; ?></td>
                              <td>
                                <?php 
                                  $sql = "SELECT * FROM category WHERE cat_id = '$category_id'";
                                  $readCat = mysqli_query($db, $sql);
                                  while ($row = mysqli_fetch_assoc($readCat)) {
                                    $cat_id   = $row['cat_id'];
                                    $cat_name = $row['cat_name'];
                                  }
                                  echo $cat_name;
                                ?>   
                              </td>
                              <td>
                                <?php 
                                  $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                  $readUser = mysqli_query($db, $sql);
                                  while ($row = mysqli_fetch_assoc($readUser)) {
                                    $id   = $row['id'];
                                    $name = $row['name'];
                                  }
                                  echo $name;
                                ?>
                              </td>
                              <td>
                                <?php
                                  if ( $status == 0 ){ ?>
                                    <span class="badge badge-danger">Draft</span>
                                  <?php }
                                  else if ( $status == 1 ){ ?>
                                    <span class="badge badge-success">Published</span>
                                  <?php }
                                ?>
                              </td>
                              <td><?php echo $post_date; ?></td>
                              <td>
                                <a class="btn btn-info btn-sm" href="post.php?do=Edit&edit=<?php echo $post_id; ?>">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $post_id; ?>">
                                  <i class="fas fa-trash">
                                  </i>
                                </a>
                              </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete<?php echo $post_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this post?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="delete-option text-center">
                                      <ul>
                                        <li><a href="post.php?do=Delete&delete=<?php echo $post_id; ?>" class="btn btn-danger">Delete</a></li>
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
                </div>
              </div>
            <?php }

            else if ( $do == 'Add' ){ ?>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Add New Post</h3>
                  </div>
                  <div class="card-body" style="display: block;">
                    <div class="row">
                      <div class="col-lg-6">
                        <form action="post.php?do=Insert" method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required="required">
                          </div>

                          <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" required>
                              <option value="">Please Select Post Category</option>
                              <?php 
                                $sql = "SELECT * FROM category WHERE status = 1 ORDER BY cat_name ASC";
                                $readCat = mysqli_query($db, $sql);
                                while ($row = mysqli_fetch_assoc($readCat)) {
                                  $cat_id   = $row['cat_id'];
                                  $cat_name = $row['cat_name'];
                                  ?>
                                  <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                <?php }
                              ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Publish Status</label>
                            <select name="status" class="form-control" required>
                              <option value="">Please Select Post Status</option>
                              <option value="0">Draft</option>
                              <option value="1">Published</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Meta Tags (Give inputs separated by space)</label>
                            <input type="text" name="meta" class="form-control">
                          </div>

                          <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="image" class="form-control-file">
                          </div>

                      </div>

                      <div class="col-lg-6">
                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="15" required="required"></textarea>
                          </div>

                          <div class="form-group">
                            <input type="submit" name="addPost" class="btn btn-block btn-primary btn-flat" value="Publish Post">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }

            else if ( $do == 'Insert' ){
              if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                $title        = $_POST['title'];
                $category_id  = $_POST['category_id'];
                $status       = $_POST['status'];
                $meta         = trim($_POST['meta']);
                $description  = mysqli_real_escape_string($db, $_POST['description']);
                $author_id    = $_SESSION['id'];

                // Preapre the Image
                $imageName    = $_FILES['image']['name'];
                $imageSize    = $_FILES['image']['size'];
                $imageTmp     = $_FILES['image']['tmp_name'];

                $imageAllowedExtension = array("jpg", "jpeg", "png");
                $imageExtension = strtolower( end( explode('.', $imageName) ) );
                
                $formErrors = array();

                if ( strlen($title) < 7 ){
                  array_push($formErrors, 'Title name is too short!!!');
                }
                if ( !empty($imageName) ){
                  if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                    array_push($formErrors, 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image');
                  }
                  if ( !empty($imageSize) && $imageSize > 2097152 ){
                    array_push($formErrors, 'Image Size is Too Large! Allowed Image size Max is 2 MB.');
                  }
                }

                // Print the Errors 
                foreach( $formErrors as $key => $error ){
                  echo '<div class="alert alert-warning">' . $error . '</div>';
                }

                if ( empty($formErrors) ){

                  if (!empty($imageName)) {
                    // Change the Image Name
                    $image = rand(0, 999999) . '_' .$imageName;
                    // Upload the Image to its own Folder Location
                    move_uploaded_file($imageTmp, "img\post\\" . $image );

                    $sql = "INSERT INTO post (title, description, image, category_id, author_id, status, meta, post_date) VALUES ('$title', '$description', '$image', '$category_id', '$author_id', '$status', '$meta', now() )";

                    $addPost = mysqli_query($db, $sql);

                    if ( $addPost ){
                      $_SESSION['message'] = 'New Post Added Successfully!';
                      header("Location: post.php?do=Manage");
                      exit();
                    }
                    else{
                      die("MySQLi Query Failed." . mysqli_error($db));
                    }
                  }
                  else{
                    $sql = "INSERT INTO post (title, description, category_id, author_id, status, meta, post_date) VALUES ('$title', '$description', '$category_id', '$author_id', '$status', '$meta', now() )";

                    $addPost = mysqli_query($db, $sql);

                    if ( $addPost ){
                      $_SESSION['message'] = 'New Post Added Successfully!';
                      header("Location: post.php?do=Manage");
                      exit();
                    }
                    else{
                      die("MySQLi Query Failed." . mysqli_error($db));
                    }
                  }
                }
              }
            }

            else if ( $do == 'Edit' ){ 
              if ( isset($_GET['edit']) ){
                $editID = $_GET['edit'];


                $sql = "SELECT * FROM post WHERE post_id = '$editID'";
                $readPost = mysqli_query($db, $sql);
                while( $row = mysqli_fetch_assoc($readPost) ){
                  $post_id      = $row['post_id'];
                  $title        = $row['title'];
                  $description  = $row['description'];
                  $image        = $row['image'];
                  $category_id  = $row['category_id'];
                  $author_id    = $row['author_id'];
                  $status       = $row['status'];
                  $meta         = $row['meta'];
                  $post_date    = $row['post_date'];
                  ?>

                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Update User Information</h3>
                      </div>
                      <div class="card-body" style="display: block;">
                        <div class="row">
                          <div class="col-lg-6">
                            <form action="post.php?do=Update" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required="required" value="<?php echo $title; ?>">
                              </div>

                              <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" required>
                                  <option value="">Please Select Post Category</option>
                                  <?php 
                                    $sql = "SELECT * FROM category WHERE status = 1 ORDER BY cat_name ASC";
                                    $readCat = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_assoc($readCat)) {
                                      $cat_id   = $row['cat_id'];
                                      $cat_name = $row['cat_name'];
                                      ?>

                                      <option value="<?php echo $cat_id; ?>" <?php if ($category_id == $cat_id) { echo 'selected'; } ?>><?php echo $cat_name; ?></option>

                                    <?php }
                                  ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Publish Status</label>
                                <select name="status" class="form-control" required>
                                  <option value="">Please Select Post Status</option>
                                  <option value="0" <?php if ($status == 0) { echo 'selected'; } ?> >Draft</option>
                                  <option value="1" <?php if ($status == 1) { echo 'selected'; } ?> >Published</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Meta</label>
                                <input type="text" name="meta" class="form-control" value="<?php echo $meta; ?>">
                              </div>

                              <div class="form-group">
                                <label>Upload Post Thumbnail</label>
                                <?php
                                  if ( !empty($image) ){ ?>
                                    <img src="img/post/<?php echo $image; ?>" class="form-post-img">
                                  <?php }
                                  else{
                                    echo "No Image uploaded";
                                  }
                                ?>
                                <input type="file" name="image" class="form-control-file">
                              </div>
                          </div>

                          <div class="col-lg-6">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="18" required="required"><?php echo $description; ?>
                                </textarea>
                              </div>
                              <div class="form-group">
                                <input type="hidden" name="updatePostID" value="<?php echo $post_id; ?>">
                                <input type="submit" name="updatePost" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                              </div>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
              <?php    
                }// End while
              }// End isset if
            } // End Main else if

            else if ( $do == 'Update' ){
              // Update Start
              if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                $updatePostID = $_POST['updatePostID'];
                $title        = $_POST['title'];
                $category_id  = $_POST['category_id'];
                $status       = $_POST['status'];
                $meta         = trim($_POST['meta']);
                $description  = mysqli_real_escape_string($db, $_POST['description']);
                $imageName    = $_FILES['image']['name'];

                if ( !empty($imageName) ){
                  // Preapre the Image
                  $imageSize    = $_FILES['image']['size'];
                  $imageTmp     = $_FILES['image']['tmp_name'];

                  $imageAllowedExtension = array("jpg", "jpeg", "png");
                  $imageExtension = strtolower( end( explode('.', $imageName) ) );
                  
                  $formErrors = array();

                  if ( strlen($title) < 7 ){
                    array_push($formErrors, 'Title name is too short!!!');
                  }
                  if ( !empty($imageName) ){
                    if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                      array_push($formErrors, 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image');
                    }
                    if ( !empty($imageSize) && $imageSize > 2097152 ){
                      array_push($formErrors, 'Image Size is Too Large! Allowed Image size Max is 2 MB.');
                    }
                  }
                }

                // Print the Errors 
                foreach( $formErrors as $key => $error ){
                  echo '<div class="alert alert-warning">' . $error . '</div>';
                }

                if ( empty($formErrors) ){
                  // Upload Image
                  if (!empty($imageName) ){
                    // Delete the Existing Image while update the new image
                    $deleteImageSQL = "SELECT * FROM post WHERE post_id = '$updatePostID'";
                    $data = mysqli_query($db, $deleteImageSQL);
                    while( $row = mysqli_fetch_assoc($data) ){
                      $existingImage = $row['image'];
                    }
                    unlink('img/post/'. $existingImage);
                     
                    // Change the Image Name
                    $image = rand(0, 999999) . '_' .$imageName;
                    // Upload the Image to its own Folder Location
                    move_uploaded_file($imageTmp, "img\post\\" . $image );

                    $sql = "UPDATE post SET title = '$title', description = '$description', image = '$image', category_id = '$category_id', status = '$status', meta = '$meta' WHERE post_id = '$updatePostID' ";

                    $addPost = mysqli_query($db, $sql);

                    if ( $addPost ){
                      $_SESSION['message'] = 'Post Updated Successfully!';
                      header("Location: post.php?do=Manage");
                      exit();
                    }
                    else{
                      die("MySQLi Query Failed." . mysqli_error($db));
                    }
                  }
                  // Change the Image Only
                  else if (empty($imageName) ){
                    $sql = "UPDATE post SET title = '$title', description = '$description', category_id = '$category_id', status = '$status', meta = '$meta' WHERE post_id = '$updatePostID' ";

                    $addPost = mysqli_query($db, $sql);

                    if ( $addPost ){
                      $_SESSION['message'] = 'Post Updated Successfully!';
                      header("Location: post.php?do=Manage");
                      exit();
                    }
                    else{
                      die("MySQLi Query Failed." . mysqli_error($db));
                    }
                  }
                }

              }
              // Update End
            }

            else if ( $do == 'Delete' ){
              
              if (isset($_GET['delete'])){
                $deleteID = $_GET['delete'];

                // Delete the Existing Image while Delete the user account
                $deleteImageSQL = "SELECT * FROM post WHERE post_id = '$deleteID'";
                $data = mysqli_query($db, $deleteImageSQL);
                while( $row = mysqli_fetch_assoc($data) ){
                  $existingImage = $row['image'];
                }
                if (!empty($existingImage)) {
                  unlink('img/post/'. $existingImage);
                }

                // Delete the user data from db
                $sql = "DELETE FROM post WHERE post_id = '$deleteID'";
                $deletePostData = mysqli_query($db, $sql);

                if ( $deletePostData ){
                  $_SESSION['message'] = 'Post Deleted Successfully!';
                  header("Location: post.php?do=Manage");
                  exit();
                }
                else{
                  die("MySQLi Query Failed." . mysqli_error($db));
                }
              }
            }
          ?>
          
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