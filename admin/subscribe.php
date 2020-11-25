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
            <h1 class="m-0 text-dark">Subscribed Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Subscribed Users</li>
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
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subscribed User List</h3>
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
                <table id="allRecords" class="table table-striped table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#Sl.</th>
                      <th scope="col">Subscribed Email Address</th>
                      <th scope="col">Subscription date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query = "SELECT * FROM subscription_list ORDER BY id DESC";
                      $readContacts = mysqli_query($db, $query);
                      $i = 0;

                      while( $row = mysqli_fetch_assoc($readContacts) ) {
                        $id           = $row['id'];
                        $subs_email   = $row['subs_email'];
                        $subs_date    = date("h:i, d-m-Y", strtotime($row['subs_date']));
                        $i++;
                        ?>

                        <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $subs_email; ?></td>
                          <td><?php echo $subs_date; ?></td>
                        </tr>

                      <?php }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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