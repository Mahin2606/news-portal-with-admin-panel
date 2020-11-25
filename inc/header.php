<?php
    ob_start();
    include "admin/inc/db.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Description -->
    <meta name="description" content="Blue Chip: Corporate Multi Purpose Business Template" />
    <meta name="author" content="Blue Chip" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/favicon.png" />

    <title>News Portal - Blog Website</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

    <!-- Flat Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- Fency Box CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.min.css">

    <!-- Theme Main Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>

  <body>
    <!-- :::::::::: Header Section Start :::::::: -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                      <a class="navbar-brand" href="index.php"><h3>Blog Portal</h3></a>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                          <?php
                            $sql = "SELECT * FROM category WHERE status = 1 AND is_parent = 0 ORDER BY cat_name ASC";
                            $allCat = mysqli_query($db, $sql);

                            while ($row = mysqli_fetch_assoc($allCat)) {
                                $cat_id       = $row['cat_id'];
                                $cat_name     = $row['cat_name'];
                                $cat_desc     = $row['cat_desc'];
                                $is_parent    = $row['is_parent'];
                                $status       = $row['status'];

                                $subSql = "SELECT * FROM category WHERE status = 1 AND is_parent = '$cat_id'";
                                $subCat = mysqli_query($db, $subSql);
                                $countSubCat = mysqli_num_rows($subCat);
                                
                                if ($countSubCat == 0) { ?>
                                  <li class="nav-item active">
                                    <a class="nav-link" href="category.php?catId=<?php echo $cat_id; ?>">
                                      <?php echo $cat_name; ?>
                                    </a>
                                  </li>
                                <?php }
                                else { ?>
                                  <li class="nav-item active dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?php echo $cat_name; ?>
                                    </a>
                                    <div class="dropdown-menu bs-dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="category.php?catId=<?php echo $cat_id; ?>"><?php echo 'See all from ' . $cat_name; ?></a>
                                      <?php
                                        while ($row = mysqli_fetch_assoc($subCat)) {
                                          $subCat_id = $row['cat_id'];
                                          $subCat_name = $row['cat_name'];
                                          ?>
                                          <a class="dropdown-item" href="category.php?catId=<?php echo $subCat_id; ?>"><?php echo $subCat_name; ?></a>
                                        <?php }
                                      ?>
                                    </div>
                                  </li>
                                <?php }
                            }
                          ?>
                        </ul>
                      </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ::::::::::: Header Section End ::::::::: -->