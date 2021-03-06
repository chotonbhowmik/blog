
<?php
    include "inc/header.php";
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

    <title>Blue Chip | Blog Right Sidebar</title>

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
    
    <!-- ::::::::::: Header Section End ::::::::: -->

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Blog</li>
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
                 if (isset($_POST['searchbtn'])) {

                    $searchContent = $_POST['search'];

                    $sql = "SELECT * FROM post WHERE title LIKE '%$searchContent%' OR description LIKE '%$searchContent%' ORDER BY post_id DESC ";
                    
                    $searchPost = mysqli_query($db, $sql);
                    $searchCount = mysqli_num_rows($searchPost); 

                    if ($searchCount == 0) { ?>
                         <div class="alert alert-warning">opss!! No Search found.</div>

                  <?php   }
                    else{

                     while ($row = mysqli_fetch_assoc($searchPost)) {

                        $post_id          =  $row['post_id'];
                        $title            =  $row['title'];
                        $description      =  $row['description'];
                        $image            =  $row['image'];
                        $category_id      =  $row['category_id'];
                        $author_id        =  $row['author_id'];
                        $status           =  $row['status'];
                        $meta             =  $row['meta'];
                        $post_date        =  $row['post_date'];
                          ?>
                        <h4>Your search result for - <strong><?php echo $searchContent; ?> </strong> - Total post found <?php echo $searchCount ; ?></h4>

                          <!-- Single Item Blog Post Start -->
                    <div class="blog-post">
                        <!-- Blog Banner Image -->
                        <div class="blog-banner">
                            <a href="single.php?post=<?php echo $post_id; ?>">
                                <img src="admin/img/post/<?php echo $image; ?>">
                                <!-- Post Category Names -->
                                <div class="blog-category-name">

                                    <?php
                                    $sql = "SELECT * FROM category WHERE cat_id = '$category_id'";
                                    $readCat = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_assoc($readCat)) {

                                        $cat_id    = $row['cat_id'];
                                        $cat_name  = $row['cat_name'];
                                        ?>
                                        <h6><?php echo $cat_name; ?></h6>
                                        
                                    <?php   }



                                    ?>
                                    
                                </div>
                            </a>
                        </div>
                        <!-- Blog Title and Description -->
                        <div class="blog-description">
                            <a href="single.php?post=<?php echo $post_id; ?>">
                                <h3 class="post-title"><?php echo $title; ?></h3>
                            </a>
                            <p><?php echo substr($description, 0, 500)." ....." ; ?></p>
                            <!-- Blog Info, Date and Author -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="blog-info">
                                        <ul>
                                            <li><i class="fa fa-calendar"></i><?php echo $post_date; ?></li>
                                            <li>
                                                <?php
                                                $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                                $readUser = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_assoc($readUser)) {

                                                    $id   = $row['id'];
                                                    $name = $row['name'];

                                                }

                                                ?>
                                                <i class="fa fa-user"></i> Posted by - <?php echo $name; ?></li>
                                            <!-- <li><i class="fa fa-heart"></i>(50)</li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 read-more-btn">
                                    <a href="single.php?post=<?php echo $post_id; ?>" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item Blog Post End -->


                    <?php    }

                    }
                 }
                 else if (isset($_GET['meta'])){
                       $searchTag = $_GET['meta'];

                    $sql = "SELECT * FROM post WHERE title LIKE '%$searchTag%' OR description LIKE '%$searchTag%' OR meta LIKE '%$searchTag%' ORDER BY post_id DESC ";
                    
                    $searchPost = mysqli_query($db, $sql);
                    $searchCount = mysqli_num_rows($searchPost); 

                    if ($searchCount == 0) { ?>
                         <div class="alert alert-warning">opss!! No Search found.</div>

                  <?php   }
                    else{

                     while ($row = mysqli_fetch_assoc($searchPost)) {

                        $post_id          =  $row['post_id'];
                        $title            =  $row['title'];
                        $description      =  $row['description'];
                        $image            =  $row['image'];
                        $category_id      =  $row['category_id'];
                        $author_id        =  $row['author_id'];
                        $status           =  $row['status'];
                        $meta             =  $row['meta'];
                        $post_date        =  $row['post_date'];
                          ?>
                        <h4>Post for meta tag - <strong><?php echo $searchTag; ?> </strong> - Total post found <?php echo $searchCount ; ?></h4>

                          <!-- Single Item Blog Post Start -->
                    <div class="blog-post">
                        <!-- Blog Banner Image -->
                        <div class="blog-banner">
                            <a href="single.php?post=<?php echo $post_id; ?>">
                                <img src="admin/img/post/<?php echo $image; ?>">
                                <!-- Post Category Names -->
                                <div class="blog-category-name">

                                    <?php
                                    $sql = "SELECT * FROM category WHERE cat_id = '$category_id'";
                                    $readCat = mysqli_query($db, $sql);
                                    while ($row = mysqli_fetch_assoc($readCat)) {

                                        $cat_id    = $row['cat_id'];
                                        $cat_name  = $row['cat_name'];
                                        ?>
                                        <h6><?php echo $cat_name; ?></h6>
                                        
                                    <?php   }



                                    ?>
                                    
                                </div>
                            </a>
                        </div>
                        <!-- Blog Title and Description -->
                        <div class="blog-description">
                            <a href="single.php?post=<?php echo $post_id; ?>">
                                <h3 class="post-title"><?php echo $title; ?></h3>
                            </a>
                            <p><?php echo substr($description, 0, 500)." ....." ; ?></p>
                            <!-- Blog Info, Date and Author -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="blog-info">
                                        <ul>
                                            <li><i class="fa fa-calendar"></i><?php echo $post_date; ?></li>
                                            <li>
                                                <?php
                                                $sql = "SELECT * FROM users WHERE id = '$author_id'";
                                                $readUser = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_assoc($readUser)) {

                                                    $id   = $row['id'];
                                                    $name = $row['name'];

                                                }

                                                ?>
                                                <i class="fa fa-user"></i> Posted by - <?php echo $name; ?></li>
                                            <!-- <li><i class="fa fa-heart"></i>(50)</li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 read-more-btn">
                                    <a href="single.php?post=<?php echo $post_id; ?>" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item Blog Post End -->


                    <?php    }

                    }

                 }



                 ?>


                </div>



                <!-- Blog Right Sidebar -->
                <div class="col-md-4">

                    <!-- Latest News -->
                    <div class="widget">
                        <h4>Latest News</h4>
                        <div class="title-border"></div>
                        
                        <!-- Sidebar Latest News Slider Start -->
                        <div class="sidebar-latest-news owl-carousel owl-theme">
                            <!-- First Latest News Start -->
                            <div class="item">
                                <div class="latest-news">
                                    <!-- Latest News Slider Image -->
                                    <div class="latest-news-image">
                                        <a href="#">
                                            <img src="assets/images/blog/test.jpg">
                                        </a>
                                    </div>
                                    <!-- Latest News Slider Heading -->
                                    <h5>CONSECTETUR ADIPISICING ELIT, SED DO EIUSMOD.</h5>
                                    <!-- Latest News Slider Paragraph -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                                </div>
                            </div>
                            <!-- First Latest News End -->
                            
                            <!-- Second Latest News Start -->
                             <div class="item">
                                <div class="latest-news">
                                    <!-- Latest News Slider Image -->
                                    <div class="latest-news-image">
                                        <a href="#">
                                            <img src="assets/images/blog/test.jpg">
                                        </a>
                                    </div>
                                    <!-- Latest News Slider Heading -->
                                    <h5>CONSECTETUR ADIPISICING ELIT, SED DO EIUSMOD.</h5>
                                    <!-- Latest News Slider Paragraph -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                                </div>
                            </div> 
                            <!-- Second Latest News End -->
                            
                            <!-- Third Latest News Start -->
                            <div class="item">
                                <div class="latest-news">
                                    <!-- Latest News Slider Image -->
                                    <div class="latest-news-image">
                                        <a href="#">
                                            <img src="assets/images/blog/test.jpg">
                                        </a>
                                    </div>
                                    <!-- Latest News Slider Heading -->
                                    <h5>CONSECTETUR ADIPISICING ELIT, SED DO EIUSMOD.</h5>
                                    <!-- Latest News Slider Paragraph -->
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                                </div>
                            </div>
                            <!-- Third Latest News End -->
                        </div>
                        <!-- Sidebar Latest News Slider End -->
                    </div>


                    

                    <!-- Recent Post -->
                    <div class="widget">
                        <h4>Recent Posts</h4>
                        <div class="title-border"></div>
                        <div class="recent-post">
                            <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                        <img src="assets/images/corporate-team/team-1.jpg">
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <h5>Corporate World is Here with Technology</h5>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>Dec 15, 2018</li>
                                            <li><i class="fa fa-comment-o"></i>15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Post Item Content End -->

                            <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                        <img src="assets/images/corporate-team/team-1.jpg">
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <h5>Corporate World is Here with Technology</h5>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>Dec 15, 2018</li>
                                            <li><i class="fa fa-comment-o"></i>15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Post Item Content End -->

                            <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                        <img src="assets/images/corporate-team/team-1.jpg">
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <h5>Corporate World is Here with Technology</h5>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>Dec 15, 2018</li>
                                            <li><i class="fa fa-comment-o"></i>15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Post Item Content End -->

                            <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                        <img src="assets/images/corporate-team/team-1.jpg">
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <h5>Corporate World is Here with Technology</h5>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>Dec 15, 2018</li>
                                            <li><i class="fa fa-comment-o"></i>15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Post Item Content End -->

                        </div>
                    </div>

                    <!-- All Category -->
                    <div class="widget">
                        <h4>Blog Categories</h4>
                        <div class="title-border"></div>
                        <!-- Blog Category Start -->
                        <div class="blog-categories">
                            <ul>
                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    Information Technology 
                                    <span>[22]</span>
                                </li>
                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    Corporate News 
                                    <span>[20]</span>
                                </li>
                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    Web Design and Development 
                                    <span>[35]</span>
                                </li>
                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    Social Media Marketing 
                                    <span>[29]</span>
                                </li>
                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    Search Engine Optimization 
                                    <span>[27]</span>
                                </li>
                            </ul>
                        </div>
                        <!-- Blog Category End -->
                    </div>

                    <!-- Recent Comments -->
                    <div class="widget">
                        <h4>Recent Comments</h4>
                        <div class="title-border"></div>
                        <div class="recent-comments">
                            
                            <!-- Recent Comments Item Start -->
                            <div class="recent-comments-item">
                                <div class="row">
                                    <!-- Comments Thumbnails -->
                                    <div class="col-md-4">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                    <!-- Comments Content -->
                                    <div class="col-md-8 no-padding">
                                        <h5>admin on blog posts</h5>
                                        <!-- Comments Date -->
                                        <ul>
                                            <li>
                                                <i class="fa fa-clock-o"></i>Dec 15, 2018
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Comments Item End -->

                            <!-- Recent Comments Item Start -->
                            <div class="recent-comments-item">
                                <div class="row">
                                    <!-- Comments Thumbnails -->
                                    <div class="col-md-4">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                    <!-- Comments Content -->
                                    <div class="col-md-8 no-padding">
                                        <h5>admin on blog posts</h5>
                                        <!-- Comments Date -->
                                        <ul>
                                            <li>
                                                <i class="fa fa-clock-o"></i>Dec 15, 2018
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Comments Item End -->

                            <!-- Recent Comments Item Start -->
                            <div class="recent-comments-item">
                                <div class="row">
                                    <!-- Comments Thumbnails -->
                                    <div class="col-md-4">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                    <!-- Comments Content -->
                                    <div class="col-md-8 no-padding">
                                        <h5>admin on blog posts</h5>
                                        <!-- Comments Date -->
                                        <ul>
                                            <li>
                                                <i class="fa fa-clock-o"></i>Dec 15, 2018
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Comments Item End -->

                        </div>
                    </div>

                    <!-- Meta Tag -->
                    <div class="widget">
                        <h4>Tags</h4>
                        <div class="title-border"></div>
                        <!-- Meta Tag List Start -->
                        <div class="meta-tags">
                            <span>Business</span>
                            <span>Technology</span>
                            <span>Corporate</span>
                            <span>Web Design</span>
                            <span>Development</span>
                            <span>Graphic</span>
                            <span>Digital Marketing</span>
                            <span>SEO</span> 
                            <span>Social Media</span>          
                        </div>
                        <!-- Meta Tag List End -->
                    </div>

                </div>
                <!-- Right Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    



    <!-- :::::::::: Footer Buy Now Section Start :::::::: -->
    <section class="buy-now">
        <div class="container">
            <!-- But Now Row Start -->
            <div class="row">
                <!-- Left Side Content -->
                <div class="col-md-9">
                    <h4><span>Blue Chip</span> - Multipurpose Business Corporate Website Template</h4>
                </div>
                <!-- Right Side Button -->
                <div class="col-md-3">
                    <button type="button" class="btn-main"><i class="fa fa-cart-plus"></i> Buy Now</button>
                </div>
            </div>
            <!-- But Now Row End -->
        </div>
    </section>
    <!-- ::::::::::: Footer Buy Now Section End ::::::::: -->


    <!-- :::::::::: Footer Section Start :::::::: -->
    <footer>
        <!-- Footer Widget Section Start -->
        <div class="footer-widget background-img section">
            <div class="container">
                <div class="row">

                    <!-- Footer Widget One Start-->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>Blue</span> Chip</h4>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard Lorem Ipsum has been the</p>
                        <!-- Social Media -->
                        <div class="widget-title">
                            <h4><span>Social</span> Media</h4>
                        </div>

                        <div class="social-media">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
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
                                <li><a href="">Portfolio</a></li>
                                <li><a href="">Pages</a></li>
                                <li><a href="">FAQ</a></li>
                                <li><a href="">Terms of Use</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Contact Us</a></li>
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
                                <li>
                                    <a><i class="fa fa-home"></i>7/H, Banani, Dhaka-1213</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-envelope-o"></i>example@yourdomain.com</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-fax"></i>+880 123 456 789</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-phone"></i>+880 123 456 789</a>
                                </li>
                                <li>
                                    <a><i class="fa fa-clock-o"></i>9.00 am - 5.00 pm</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Widget Three End -->

                    <!-- Footer Widget Four Start -->
                    <div class="col-md-3">
                        <div class="widget-title">
                            <h4><span>Subscribe</span> Here</h4>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                        <!-- Subscribe From Start -->
                        <form action="" method="">
                            <div class="form-group ">
                                <input type="email" name="email" placeholder="Enter Your Email" autocomplete="off" class="form-input" required="required">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <!-- Subscribe Button -->
                            <div class="">
                                <button type="submit" class="btn-main"><i class="fa fa-paper-plane-o"></i> Subscribe</button>
                            </div>
                        </form>
                        <!-- Subscribe From End -->
                    </div>
                    <!-- Footer Widget Four End -->

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
                        <p><a href="">Theme Express</a> ?? 2018 All rights reserved. Terms of use and Privacy Policy</p>
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

  </body>
</html>