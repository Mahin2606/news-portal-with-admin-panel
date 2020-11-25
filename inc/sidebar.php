<div class="col-md-4">

    <!-- Latest News -->
    <div class="widget">
        <h4>Latest News</h4>
        <div class="title-border"></div>
        
        <!-- Sidebar Latest News Slider Start -->
        <div class="sidebar-latest-news owl-carousel owl-theme">
            

            <?php
                $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 3";
                $allPost = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($allPost)) {
                    $post_id      = $row['post_id'];
                    $title        = $row['title'];
                    $description  = $row['description'];
                    $image        = $row['image'];
                    $category_id  = $row['category_id'];
                    $author_id    = $row['author_id'];
                    $status       = $row['status'];
                    $meta         = $row['meta'];
                    $post_date    = $row['post_date'];

                    $newDate = date("dS F, Y h:i:s", strtotime($post_date));
                    ?>

                    <!-- Latest News Start -->
                    <div class="item">
                        <div class="latest-news">
                            <!-- Latest News Slider Image -->
                            <div class="latest-news-image">
                                <a href="single.php?postID=<?php echo $post_id; ?>">
                                    <img src="admin/img/post/<?php echo $image; ?>">
                                </a>
                            </div>
                            <!-- Latest News Slider Heading -->
                            <h5><?php echo $title; ?></h5>
                            <!-- Latest News Slider Paragraph -->
                            <p><?php echo substr($description, 0, 70) . "..."; ?></p>
                        </div>
                    </div>
                    <!-- Latest News End -->

                <?php }
            ?>
            
        </div>
        <!-- Sidebar Latest News Slider End -->
    </div>


    <!-- Search Bar Start -->
    <div class="widget"> 
            <!-- Search Bar -->
            <h4>Blog Search</h4>
            <div class="title-border"></div>
            <div class="search-bar">
                <!-- Search Form Start -->
                <form action="search.php" method="POST">
                    <div class="form-group text-center">
                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input" required="required">
                        <i class="fa fa-paper-plane-o"></i>
                        <input type="submit" name="searchBtn" class="btn-main" value="Search" style="margin-top: 20px;">
                    </div>
                </form>
                <!-- Search Form End -->
            </div>
    </div>
    <!-- Search Bar End -->

    <!-- Recent Post -->
    <div class="widget">
        <h4>Recent Posts</h4>
        <div class="title-border"></div>
        <div class="recent-post">

            <?php
                $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 3";
                $allPost = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($allPost)) {
                    $post_id      = $row['post_id'];
                    $title        = $row['title'];
                    $description  = $row['description'];
                    $image        = $row['image'];
                    $category_id  = $row['category_id'];
                    $author_id    = $row['author_id'];
                    $status       = $row['status'];
                    $meta         = $row['meta'];
                    $post_date    = $row['post_date'];

                    $newDate = date("dS F, Y h:i:s", strtotime($post_date));
                    ?>

                    <!-- Recent Post Item Content Start -->
                    <div class="recent-post-item">
                        <div class="row">
                            <!-- Item Image -->
                            <div class="col-md-4">
                                <a href="single.php?postID=<?php echo $post_id; ?>">
                                    <img src="admin/img/post/<?php echo $image; ?>">
                                </a>
                            </div>
                            <!-- Item Tite -->
                            <div class="col-md-8 no-padding">
                                <a href="single.php?postID=<?php echo $post_id; ?>">
                                    <h5><?php echo $title; ?></h5>
                                </a>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i><?php echo $newDate; ?></li>
                                    <?php
                                        $cmt_sql = "SELECT * FROM comments WHERE cmt_post_id = '$post_id' AND status = 1 ORDER BY cmt_id DESC";
                                        $readComments = mysqli_query($db, $cmt_sql);
                                        $totalComments = mysqli_num_rows($readComments);
                                    ?>
                                    <li><i class="fa fa-comment-o"></i><?php echo $totalComments; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Post Item Content End -->

                <?php }
            ?>

        </div>
    </div>

    <!-- All Category -->
    <div class="widget">
        <h4>Blog Categories</h4>
        <div class="title-border"></div>
        <?php
            $sql = "SELECT * FROM category WHERE status = 1";
            $readCat = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_assoc($readCat)) {
                $cat_id   = $row['cat_id'];
                $cat_name = $row['cat_name'];

                $query = "SELECT * FROM post p, category c WHERE p.status = 1 AND p.category_id = c.cat_id AND (c.cat_id = '$cat_id' OR c.is_parent = '$cat_id')";
                $readPost = mysqli_query($db, $query);
                $postCount = mysqli_num_rows($readPost);
                ?>

                <!-- Blog Category Start -->
                <div class="blog-categories">
                    <ul>
                        <!-- Category Item -->
                        <li>
                            <a href="category.php?catId=<?php echo $cat_id; ?>">
                                <i class="fa fa-check"></i>
                                <?php echo $cat_name; ?> 
                                <span>[<?php echo $postCount; ?>]</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Blog Category End -->

            <?php }
        ?>
        
    </div>

    <!-- Recent Comments -->
    <div class="widget">
        <h4>Recent Comments</h4>
        <div class="title-border"></div>
        <div class="recent-comments">

            <?php
                $sql = "SELECT * FROM comments WHERE status = 1 ORDER BY cmt_id DESC LIMIT 3";
                $recentComments = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($recentComments)) {
                    $cmt_id             = $row['cmt_id'];
                    $cmt_desc           = $row['cmt_desc'];
                    $cmt_post_id        = $row['cmt_post_id'];
                    $cmt_visitor_name   = $row['cmt_visitor_name'];
                    $cmt_visitor_email  = $row['cmt_visitor_email'];
                    $status             = $row['status'];
                    $is_parent          = $row['is_parent'];
                    $cmt_date           = date("h:i, d-m-Y", strtotime($row['cmt_date']));
                    ?>

                    <!-- Recent Comments Item Start -->
                    <div class="recent-comments-item">
                        <div class="row">
                            <!-- Comments Thumbnails -->
                            <div class="col-md-4">
                                <i class="fa fa-comments-o"></i>
                            </div>
                            <!-- Comments Content -->
                            <?php
                                $cmt_post_sql = "SELECT title AS 'cmtPostTitle' FROM post WHERE post_id = '$cmt_post_id'";
                                $desiredPost = mysqli_query($db, $cmt_post_sql);
                                while ($row = mysqli_fetch_assoc($desiredPost)) {
                                    extract($row);
                                    ?>

                                    <div class="col-md-8 no-padding">
                                        <a href="single.php?postID=<?php echo $cmt_post_id; ?>">
                                            <h5><?php echo $cmt_visitor_name . "  on <span>" . $cmtPostTitle."</span>"; ?></h5>
                                            <p><?php echo substr($cmt_desc, 0, 20) . "..."; ?></p>
                                            <!-- Comments Date -->
                                            <ul>
                                                <li>
                                                    <i class="fa fa-clock-o"></i><?php echo $cmt_date; ?>
                                                </li>
                                            </ul>
                                        </a>
                                    </div>

                                <?php }
                            ?>
                        </div>
                    </div>
                    <!-- Recent Comments Item End -->

                <?php }
            ?>

        </div>
    </div>

    <!-- Meta Tag -->
    <div class="widget">
        <h4>Tags</h4>
        <div class="title-border"></div>

        <!-- Meta Tag List Start -->
        <div class="meta-tags">
            <?php
                $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 3";
                $allPost = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($allPost)) {
                    $post_id      = $row['post_id'];
                    $meta         = $row['meta'];

                    $arr =  explode(" ", $meta);

                    foreach ($arr as $value) { ?>
                        <a href="search.php?searchTag=<?php echo $value; ?>">
                            <span> <?php echo $value; ?></span> 
                        </a>
                    <?php }
                }
            ?>
      
        </div>
        <!-- Meta Tag List End -->
        
    </div>

</div>