<?php
     include "inc/header.php";
?>
    
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

                  $total_page = $db->query("SELECT * FROM post")->num_rows;
                  $page =  isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                  $num_result_per_page = 3;

                    // $sql = "SELECT * FROM posts WHERE status = 1 ORDER BY post_id DESC LIMIT ?, ?";
                    if($stmt = $db->prepare('SELECT * FROM post WHERE status = 1 ORDER BY post_id DESC LIMIT ?, ?'))

                    $cal_page = ($page - 1) * $num_result_per_page;
                    $stmt->bind_param('ii', $cal_page, $num_result_per_page);
                    $stmt->execute();
                    $myresult = $stmt->get_result();

                    while( $row = $myresult->fetch_assoc() ){?>
                     

                      <!-- Single Item Blog Post Start -->
                    <div class="blog-post">
                        <!-- Blog Banner Image -->
                        <div class="blog-banner">
                           <a href="single.php?view=<?php echo $row['post_id']."=". trim(str_replace(" ", "_", strtolower($row['title']))); ?>">
                                <img src="admin/img/post/<?php echo $row['image']; ?>">
                                <!-- Post Category Names -->
                                <div class="blog-category-name">
                                    <h6>
                                      <?php
                                    $cat_id = $row['category_id'];
                                  $categori = "SELECT * FROM category WHERE cat_id = '$cat_id'";
                                  $result = mysqli_query($db, $categori);
                                  while ($mycat = mysqli_fetch_assoc($result)) {
                                  $cat_id     = $mycat['cat_id'];
                                  $cat_name   = $mycat['cat_name'];
                                  echo $cat_name;
                                  } ?></h6>
                                </div>
                            </a>
                        </div>
                        <!-- Blog Title and Description -->
                        <div class="blog-description">
                             <a href="single.php?view=<?php echo $row['post_id']."=". trim(str_replace(" ", "_", strtolower($row['title']))); ?>">
                                <h3 class="post-title"><?php echo $row['title']; ?></h3>
                            </a>
                            <p><?php echo substr($row['description'], 0, 350)?></p>
                            <!-- Blog Info, Date and Author -->

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="blog-info">
                                        <ul>
                                            <li><i class="fa fa-calendar"></i><?php 

                                             echo date('d.m.Y', strtotime($row['post_date']));

                                            ?></li>
                                            <li><i class="fa fa-user"></i>by - <?php 
                                              $auth_iduser = $row['author_id'];
                                              $authname = "SELECT * FROM users WHERE id = '$auth_iduser'";
                                              $user_result = mysqli_query($db, $authname);
                                              while ($myrow = mysqli_fetch_assoc($user_result)) {
                                              $id       = $myrow['id'];
                                              $name     = $myrow['name'];
                                              echo $name;
                                              }

                                            ?></li>

                                            <li><i class="fa fa-heart"></i>(50)</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 read-more-btn">
                                    <a href="single.php?view=<?php echo $row['post_id']."=". trim(str_replace(" ", "_", strtolower($row['title']))); ?>" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item Blog Post End -->

                     <?php } ?>

                    <!-- Blog Paginetion Design Start -->
                    <?php 
                       if(ceil($total_page / $num_result_per_page) > 0) :
                    ?>
                    <div class="paginetion">
                        <ul>
                            <!-- Next Button -->
                            <?php if($page > 1) : ?>
                            <li class="blog-prev">
                                <a href="index.php?page=<?php echo $page-1; ?>"><i class="fa fa-long-arrow-left"></i>  Previous</a>
                            </li>
                          <?php else : ?>
                           <li class="blog-prev">
                                <a href="javascript:void(0)"><i class="fa fa-long-arrow-left"></i>  Previous</a>
                            </li>
                          <?php endif; ?>


                          
                            <?php if ($page-1 > 0) : ?>

                            <li><a href="index.php?page=<?php echo $page-1; ?>"><?php echo $page-1; ?></a></li>
                            <?php endif; ?>
                            
                            <li class="active"><a href="index.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>

                            <?php if ($page+1 < ceil($total_page / $num_result_per_page) + 1) : ?>

                            <li><a href="index.php?page=<?php echo $page+1; ?>"><?php echo $page+1; ?></a></li>
                            <?php endif; ?>

                            <!-- Previous Button -->
                            <?php if($page < ceil($total_page / $num_result_per_page)) : ?>
                            <li class="blog-next">
                                <a href="index.php?page=<?php echo $page+1; ?>"> Next <i class="fa fa-long-arrow-right"></i></a>
                            </li>

                          <?php else: ?>
                          <li class="blog-next">
                                <a href="javascript:void(0)"> Next <i class="fa fa-long-arrow-right"></i></a>
                            </li>

                          <?php endif; ?>
                        </ul>
                    </div>
                  <?php endif; ?>
                    <!-- Blog Paginetion Design End -->               
                </div>

                <!-- Blog Right Sidebar -->
               <?php
                    include "inc/sidebar.php";

                ?>


    
<?php
    include "inc/footer.php";

?>
