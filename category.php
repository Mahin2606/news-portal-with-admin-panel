<?php
    include "inc/header.php";
?>
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Blog Site</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Blog Category Posts</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">

                    <?php
                        if (isset($_GET['catId'])) {
                            $navCatId = $_GET['catId'];

                            $sql = "SELECT p.post_id AS 'post_id', p.title AS 'title', p.description AS 'description', p.image AS 'image', p.category_id AS 'category_id', p.author_id AS 'author_id', p.post_date AS 'post_date', c.cat_name AS 'cat_name', u.name AS 'name' FROM post p, category c, users u WHERE p.status = 1 AND p.category_id = c.cat_id AND p.author_id = u.id AND (c.cat_id = '$navCatId' OR c.is_parent = '$navCatId') ORDER BY p.post_id DESC";

                            $catPost = mysqli_query($db, $sql);
                            $rowCount = mysqli_num_rows($catPost);

                            if ($rowCount != 0) {
                                while ($row = mysqli_fetch_assoc($catPost)) {
                                    $post_id      = $row['post_id'];
                                    $title        = $row['title'];
                                    $description  = $row['description'];
                                    $image        = $row['image'];
                                    $category_id  = $row['category_id'];
                                    $author_id    = $row['author_id'];
                                    $post_date    = $row['post_date'];
                                    $cat_name     = $row['cat_name'];
                                    $name         = $row['name'];

                                    $newDate = date("dS F, Y h:i:s", strtotime($post_date));
                                    ?>

                                    <!-- Single Item Blog Post Start -->
                                    <div class="blog-post">
                                        <!-- Blog Banner Image -->
                                        <div class="blog-banner">
                                            <a href="single.php?postID=<?php echo $post_id; ?>">
                                                <img src="admin/img/post/<?php echo $image; ?>">
                                                <!-- Post Category Names -->
                                                <div class="blog-category-name">
                                                    <h6><?php echo $cat_name; ?></h6>  
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Blog Title and Description -->
                                        <div class="blog-description">
                                            <a href="single.php?postID=<?php echo $post_id; ?>">
                                                <h3 class="post-title"><?php echo $title; ?></h3>
                                            </a>
                                            <p><?php echo substr($description, 0, 250) . "...."; ?></p>
                                            <!-- Blog Info, Date and Author -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="blog-info">
                                                        <ul>
                                                            <li><i class="fa fa-calendar"></i><?php echo $newDate; ?></li>
                                                            <li>
                                                                <i class="fa fa-user"></i>Posted By - <?php echo $name; ?>
                                                            </li>
                                                            <!-- <li><i class="fa fa-heart"></i>(50)</li> -->
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 read-more-btn">
                                                    <a href="single.php?postID=<?php echo $post_id; ?>" class="btn-main">
                                                        Read More <i class="fa fa-angle-double-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Item Blog Post End -->

                                <?php }
                            }
                            else { ?>
                                <div class="alert alert-warning">Soory!! No Posts Found for This Category...</div>
                            <?php }
                        }
                    ?> 
              
                </div>



                <!-- Blog Right Sidebar -->
                <?php
                    include "inc/sidebar.php";
                ?>
                <!-- Right Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->



<?php
    include "inc/footer.php";
?>