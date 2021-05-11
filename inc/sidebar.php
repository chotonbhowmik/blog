

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
                                <form action="search.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-control" required="required">
                                        <i class="fa fa-paper-plane-o"></i>
                                        <input type="submit" name="searchbtn" class="btn-main" value="Search">
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


                                                <?php
                                            $sql = "SELECT * FROM comments WHERE cmt_post_id ='$post_id' AND cmt_status = 1";

                                            $read_comments = mysqli_query($db, $sql);
                                            $total_comment = mysqli_num_rows($read_comments);
                                                    ?>

                                            <li><i class="fa fa-comment-o"></i><?php echo $total_comment; ?></li>
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
                                    <a href="category.php?category=<?php echo $cat_name; ?>">
                                    <?php echo $cat_name; ?> </a>
                                    <span><?php echo $result; ?></span>
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


                            <?php

                            $sql = "SELECT * FROM comments WHERE cmt_status = 1 ORDER BY cat_id DESC";
                            $latest_comment = mysqli_query($db, $sql);
                            while ($row = mysqli_fetch_assoc($latest_comment)) {
                                  $cmt_id              = $row['cmt_id'];
                                  $cmt_desc            = $row['cmt_desc'];
                                  $cmt_post_id         = $row['cmt_post_id'];
                                  $cmt_author          = $row['cmt_author'];
                                  $cmt_author_email    = $row['cmt_author_email'];
                                  $cmt_status          = $row['cmt_status'];
                                  $cmt_date            = $row['cmt_date'];

                                  ?>

                                  <!-- Recent Comments Item Start -->
                            <div class="recent-comments-item">
                                <div class="row">
                                    <!-- Comments Thumbnails -->
                                    <div class="col-md-4">
                                        <i class="fa fa-comments-o"></i>
                                    </div>
                                    <!-- Comments Content -->
                                    <div class="col-md-8 no-padding">
                                        <h5><?php echo $cmt_desc; ?></h5>
                                        <!-- Comments Date -->
                                        <ul>
                                            <li>
                                                <i class="fa fa-clock-o"></i><?php echo $cmt_date; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Comments Item End -->


                          <?php  }



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
                            $sql = "SELECT * FROM post";
                            $allPosts = mysqli_query($db, $sql);
                       
                            while ($row = mysqli_fetch_assoc($allPosts)) {
                             
                            $post_id          =  $row['post_id'];
                            $meta             =  $row['meta'];

                            $tags = explode(' ', $meta);
                            foreach($tags as $tag){ ?>
                            <a href="search.php?meta=<?php echo $tag; ?>"><span><?php echo $tag; ?></span></a>

                           <?php  }

                        
                          } 


                            ?>
                            
                                     
                        </div>
                        <!-- Meta Tag List End -->
                    </div>

                </div>
                                <!-- Right Sidebar End -->

                </div>
                              
             </div>
                            
                </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->