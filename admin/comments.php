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
            <h1 class="m-0 text-dark">Manage All Comments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Comments</li>
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
            // CRUD operations for users
            $do = isset( $_GET['do'] ) ? $_GET['do'] : 'Manage';

            if ( $do == 'Manage' ){ ?>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Manage All Comments</h3>
                  </div>
                  <div class="card-body" style="display: block;">
                    
                    <table id="allRecords" class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col" style="width: 5%">#Sl.</th>
                          <th scope="col" style="width: 15%">Post Title</th>
                          <th scope="col" style="width: 10%">Visitor Name</th>
                          <th scope="col" style="width: 15%">Visitor Email</th>
                          <th scope="col" style="width: 20%">Comments</th>
                          <th scope="col" style="width: 10%">Status</th>
                          <th scope="col" style="width: 5%">Parent ID</th>
                          <th scope="col" style="width: 10%">Comment Date</th>
                          <th scope="col" style="width: 10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                          $sql = "SELECT * FROM comments ORDER BY cmt_id DESC";
                          $allComments = mysqli_query($db, $sql);
                          $i = 0;
                          while( $row = mysqli_fetch_assoc($allComments) ){
                            $id                   = $row['cmt_id'];
                            $cmt_desc             = $row['cmt_desc'];
                            $cmt_post_id          = $row['cmt_post_id'];
                            $cmt_visitor_name     = $row['cmt_visitor_name'];
                            $cmt_visitor_email    = $row['cmt_visitor_email'];
                            $status               = $row['status'];
                            $is_parent            = $row['is_parent'];
                            $cmt_date             = date("d-m-Y h:i", strtotime($row['cmt_date']));
                            $i++;
                            ?>

                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td>
                                <?php
                                  $postTitle_sql = "SELECT * FROM post WHERE post_id = '$cmt_post_id'";
                                  $readPostTitle = mysqli_query($db, $postTitle_sql);
                                  while ($row = mysqli_fetch_assoc($readPostTitle)) {
                                    $post_id    = $row['post_id'];
                                    $post_title = $row['title'];
                                    
                                    echo $post_title;
                                  }
                                ?>
                              </td>
                              <td><?php echo $cmt_visitor_name; ?></td>
                              <td><?php echo $cmt_visitor_email; ?></td>
                              <td><?php echo $cmt_desc; ?></td>
                              <td>
                                <?php
                                  if ( $status == 0 ){ ?>
                                    <span class="badge badge-warning">Draft</span>
                                  <?php }
                                  else if ( $status == 1 ){ ?>
                                    <span class="badge badge-success">Published</span>
                                  <?php }
                                  else if ( $status == 2 ){ ?>
                                    <span class="badge badge-danger">Suspended</span>
                                  <?php }
                                ?>
                              </td>
                              <td><?php echo $is_parent; ?></td>
                              <td><?php echo $cmt_date; ?></td>
                              <td>
                                <a class="btn btn-info btn-sm" href="comments.php?do=Edit&edit=<?php echo $id; ?>">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                  <i class="fas fa-trash"></i>
                                </a>
                              </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this Comment?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="delete-option text-center">
                                      <ul>
                                        <li><a href="comments.php?do=Delete&delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a></li>
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

            else if ( $do == 'Edit' ){ 
              if ( isset($_GET['edit']) ){
                $editID = $_GET['edit'];

                $sql = "SELECT * FROM comments WHERE cmt_id = '$editID'";
                $readCmt = mysqli_query($db, $sql);
                while( $row = mysqli_fetch_assoc($readCmt) ){
                  $cmt_id = $row['cmt_id'];
                  $status = $row['status'];
                  ?>

                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Draft / Publish Comment</h3>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-2"></div>
                          <div class="col-lg-8">
                            <form action="comments.php?do=Update" method="POST">
                              <div class="form-group">
                                <label>Comment Status</label>
                                <select name="status" class="form-control">
                                  <option value="">Please Select Comment Status</option>
                                  <option value="0" <?php if ( $status == 0 ){ echo 'selected'; } ?> >Draft</option>
                                  <option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?> >Published</option>
                                </select>
                              </div>
                              <div class="form-group text-center">
                                <input type="hidden" name="updateCmtID" value="<?php echo $cmt_id; ?>">
                                <input type="submit" name="updateCmt" class="btn btn-success btn-flat" value="Save Changes">
                                <a href="comments.php?do=Manage" class="btn btn-secondary btn-flat" style="margin-left: 10px;">Back</a>
                              </div>
                            </form>
                          </div>
                          <div class="col-lg-2"></div>
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
                $updateCmtID  = $_POST['updateCmtID'];
                $cmt_status   = $_POST['status'];

                $sql = "UPDATE comments SET status='$cmt_status' WHERE cmt_id = '$updateCmtID' ";

                $updateComment = mysqli_query($db, $sql);

                if ( $updateComment ){
                  $_SESSION['message'] = 'Comment Status Updated Successfully!';
                  header("Location: comments.php?do=Manage");
                  exit();
                }
                else{
                  die("MySQLi Query Failed." . mysqli_error($db));
                }
              }
              // Update End
            }

            else if ( $do == 'Delete' ){
              
              if (isset($_GET['delete'])){
                $deleteCmtID = $_GET['delete'];

                // Change the comment status data in db
                $sql = "UPDATE comments SET status = 2 WHERE cmt_id = '$deleteCmtID' ";

                $deleteComment = mysqli_query($db, $sql);

                if ( $deleteComment ){
                  $_SESSION['message'] = 'Comment Status Suspended Successfully!';
                  header("Location: comments.php?do=Manage");
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