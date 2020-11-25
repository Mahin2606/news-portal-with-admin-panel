<!-- :::::::::: Footer Section Start :::::::: -->
    <footer>
        <!-- Footer Widget Section Start -->
        <div class="footer-widget background-img section">
            <div class="container">
                <div class="row">

                    <!-- Footer Widget One Start-->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>Blog</span> Portal</h4>
                        </div>
                        <p>A blog is an informational or discussion website published on the World Wide Web consisting of discrete, often informal diary-style text posts.</p>
                    </div>
                    <!-- Footer Widget One End-->

                    <!-- Footer Widget Two Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>Useful</span> Links</h4>
                        </div>
                        <div class="useful-links">
                            <ul>
                                <li><a href="">About Us</a></li>
                                <li><a href="">Pages</a></li>
                                <li><a href="">FAQ</a></li>
                                <li><a href="">Terms of Use</a></li>
                                <li><a href="">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget Two End -->

                    <!-- Footer Widget Three Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>Contact</span> With Us</h4>
                        </div>
                        <div class="contact-with-us">
                            <ul>

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
                                    ?>

                                    <li>
                                        <a><i class="fa fa-home"></i><?php echo $address; ?></a>
                                    </li>
                                    <li>
                                        <a><i class="fa fa-envelope-o"></i><?php echo $email; ?></a>
                                    </li>
                                    <li>
                                        <a><i class="fa fa-phone"></i><?php echo $phone_one; ?></a>
                                    </li>
                                    <li>
                                        <a><i class="fa fa-mobile"></i><?php echo $phone_two; ?></a>
                                    </li>
                                    <li>
                                        <a><i class="fa fa-clock-o"></i><?php echo $off_time; ?></a>
                                    </li>

                                <?php }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget Three End -->

                    <!-- Footer Widget Four Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>Subscribe</span> Here</h4>
                        </div>
                        <p>Please subscribe to get notified for new blog posts on different subjects related to technology, politics, international and many more...</p>
                        <!-- Subscribe From Start -->
                        <form action="" method="POST">
                            <div class="form-group ">
                                <input type="email" name="email" placeholder="Enter Your Email" autocomplete="off" class="form-input" required="required">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="">
                                <button type="submit" name="subscribe" class="btn-main"><i class="fa fa-paper-plane-o"></i> Subscribe</button>
                            </div>
                        </form>
                        <!-- Subscribe From End -->
                    </div>
                    <!-- Footer Widget Four End -->

                    <?php
                        if (isset($_POST['subscribe'])) {
                            $subs_email = $_POST['email'];

                            $sql = "INSERT INTO subscription_list (subs_email, subs_date) VALUES ('$subs_email', now())";
                            $addSubs = mysqli_query($db, $sql);
                            if ($addSubs) {
                                header("Location: index.php");
                                exit();
                            }
                            else {
                                die("MySQL Connection Faild." . mysqli_error($db));
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
        <!-- Footer Widget Section End -->


        <!-- CopyRight Section Start -->
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <!-- Copyright Left Content -->
                    <div class="col-md-6">
                        <p><a href="">Theme Express</a> © 2018 All rights reserved. Terms of use and Privacy Policy</p>
                    </div>

                    <!-- Copyright Right Footer Menu Start -->
                    <div class="col-md-6">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="">About</a></li>
                                <li><a href="">FAQ</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Copyright Right Footer Menu End -->
                </div>
            </div>
        </div>
        <!-- CopyRight Section End -->
    </footer>
    <!-- ::::::::::: Footer Section End ::::::::: -->


    <!-- JQuery Library File -->
    <script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->

    <!-- Bootstrap JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <!-- Isotop JS -->
    <script src="assets/js/isotop.min.js"></script>

    <!-- Fency Box JS -->
    <script src="assets/js/jquery.fancybox.min.js"></script>

    <!-- Easy Pie Chart JS -->
    <script src="assets/js/jquery.easypiechart.js"></script>

    <!-- JQuery CounterUp JS -->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>

    <!-- BlueChip Extarnal Script -->
    <script type="text/javascript" src="assets/js/main.js"></script>

    <?php
        ob_end_flush();
    ?>

  </body>
</html>