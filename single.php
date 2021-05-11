<?php
     include "inc/header.php";
?>



    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Single Right Sidebar</li>
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
                <!-- Blog Single Posts -->
                <div class="col-md-8">


                 <?php
                 if (isset($_GET['post'])) {

                     $thePost = $_GET['post'];
                     $sql = "SELECT * FROM post WHERE post_id ='$thePost'";
                        $allPost = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($allPost)) {

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
                            <p><?php echo $description; ?></p>
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

                            </div>
                        </div>
                    </div>
                    <!-- Single Item Blog Post End -->


                         <?php   } } ?>


                    <!-- Single Comment Section Start -->
                    <div class="single-comments">
                        <!-- Comment Heading Start -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                 $post_id = '';

                        $sql = "SELECT * FROM comments WHERE cmt_post_id ='$post_id' AND cmt_status = 1";

                        $read_comments = mysqli_query($db, $sql);
                        $total_comment = mysqli_num_rows($read_comments);
 

                            ?>
                            <h4>All Latest Comments (<?php echo $total_comment; ?>)</h4>
                            <div class="title-border"></div>
                                
                            </div>
                        </div>
                        <!-- Comment Heading End -->


                        <?php
                        $post_id = '';

                        $sql = "SELECT * FROM comments WHERE cmt_post_id ='$post_id' AND cmt_status = 1 ORDER BY cmt_id DESC ";

                        $read_comments = mysqli_query($db, $sql);

                        $result = mysqli_num_rows($read_comments);

                        if ($result == 0 || empty($result)) { ?>
                            
                            <div class="alert alert-warning">No comments found in this post</div>
                            
                      <?php  }

                        else{

                          while( $row = mysqli_fetch_assoc($read_comments) ){
                          $cmt_id              = $row['cmt_id'];
                          $cmt_desc            = $row['cmt_desc'];
                          $cmt_post_id         = $row['cmt_post_id'];
                          $cmt_author          = $row['cmt_author'];
                          $cmt_author_email    = $row['cmt_author_email'];
                          $cmt_status          = $row['cmt_status'];
                          $cmt_date            = $row['cmt_date'];

                          ?>


                          <!-- Single Comment Post Start -->
                        <div class="row each-comments">
                           

                            <div class="col-md-10 no-padding">
                                <!-- Comment Box Start -->
                                <div class="comment-box">
                                    <div class="comment-box-header">
                                        <ul>
                                            <li class="post-by-name"><?php echo $cmt_author; ?></li>
                                            <li class="post-by-hour"><?php echo $cmt_date; ?></li>
                                        </ul>
                                    </div>
                                    <p><?php echo $cmt_desc; ?></p>
                                </div>
                                <!-- Comment Box End -->
                            </div>
                        </div>
                        <!-- Single Comment Post End -->

                     <?php  }
                                 
                        }




                        ?>

                        



                      
                    </div>
                    <!-- Single Comment Section End -->


                    <!-- Post New Comment Section Start -->
                    <div class="post-comments">
                        <h4>Post Your Comments</h4>
                        <div class="title-border"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        <!-- Form Start -->
                        <form action="" method="POST" class="contact-form">
                            <!-- Left Side Start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- First Name Input Field -->
                                    <div class="form-group">
                                        <input type="text" name="username" placeholder="Your Name" class="form-input" autocomplete="off" required="required">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                </div>
                                <!-- Email Address Input Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off" required="required">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Left Side End -->

                            <!-- Right Side Start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Subject Input Field -->
                                    
                                    <!-- Comments Textarea Field -->
                                    <div class="form-group">
                                        <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                    <!-- Post Comment Button -->
                                    <input type="hidden" name="post_title_cmt" value="">
                                    <input type="submit" name="addComment" class="btn-main" value="Post Your Comments">
                                </div>
                            </div>
                            <!-- Right Side End -->
                        </form>
                        <!-- Form End -->
                    </div>
                    <!-- Post New Comment Section End -->              
                </div>


                 <?php

                 if (isset($_POST['addComment']) ) {
                     
                     $username = $_POST['username'];
                     $email    = $_POST['email'];
                     $comments = $_POST['comments'];
                     $sql = "INSERT INTO comments (cmt_desc, cmt_post_id, cmt_author,  cmt_author_email, cmt_status,cmt_date) VALUES ('$comments','$post_id', '$username', '$email', 0, now())";

                     $add_comment = mysqli_query($db, $sql);
                     if ($add_comment) {
                         header("Location: single.php?id=$post_id");
                     }
                     else{
                        die("data not inserted ". mysqli_error($db));
                     }
                 }




                 ?>






                <!-- Blog Right Sidebar -->
                <div class="col-md-4">

                     <!-- Latest News -->
                    <div class="widget">
                        <h4>Latest News</h4>
                        <div class="title-border"></div>
                        
                        <!-- Sidebar Latest News Slider Start -->
                        <div class="sidebar-latest-news owl-carousel owl-theme">


                        <?php
                            $sql = "SELECT * FROM post WHERE status = 1 ORDER BY post_id DESC LIMIT 3";
                            
                        $sideBarLatestPost = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($sideBarLatestPost)) {

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
                           <!--  Latest News Start -->
                            <div class="item">
                                <div class="latest-news">
                                    <!--  News Slider Image -->
                                    <div class="latest-news-image">
                                         <a href="single.php?id=<?php echo $post_id; ?>">
                                           <img src="admin/img/post/<?php echo $image; ?>">
                                        </a>
                                    </div>
                                    <!-- Latest News Slider Heading -->
                                    <h5> 
                                        <a href="single.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a>
                                    </h5>
                                    <!-- Latest News Slider Paragraph -->
                                    <p><?php echo substr($description, 0, 20); ?></p>
                                </div>
                            </div>
                            <!--  Latest News End -->


                           <?php  }
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
                                <form>
                                    <div class="form-group">
                                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
                                        <i class="fa fa-paper-plane-o"></i>
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
                        $latestPost = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($latestPost)) {

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

                               <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                        <img src="admin/img/post/<?php echo $image; ?>">
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <a href="single.php?post=<?php echo $post_id; ?>"><?php echo $title; ?>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i><?php echo $post_date; ?></li>
                                            <li><i class="fa fa-comment-o"></i>15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Post Item Content End --> 

                         <?php    }

                             ?>

 

                        </div>
                    </div>

                    <!-- All Category -->
                    <div class="widget">
                        <h4>Blog Categories</h4>
                        <div class="title-border"></div>
                        <!-- Blog Category Start -->
                        <div class="blog-categories">
                            <ul>

                                <?php

                                 $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                        $allCat = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($allCat)) {

                          $cat_id     =    $row['cat_id'];
                          $cat_name   =    $row['cat_name'];
                          $query = "SELECT * FROM post WHERE category_id = '$cat_id'";
                          $all_cat = mysqli_query($db, $query);
                          $result = mysqli_num_rows($all_cat);

                          ?>

                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    <?php echo $cat_name; ?> 
                                    <span>[<?php echo $result; ?>]</span>
                                </li>
                                

                          <?php }


                          ?>
                                
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

                    <!-- Meta Tag Start -->
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
                    <!-- Meta Tag End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    

<?php
   include "inc/footer.php";
?>