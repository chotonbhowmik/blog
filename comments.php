<?php
    include "inc/header.php";
?>

  <!-- Navbar -->
  <?php
    include "inc/topbar.php";
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?php
    include "inc/menu.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dahboard</a></li>
              <li class="breadcrumb-item active">Manage All Post</li>
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

         
               
      <?php

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if ($do == 'Manage') { ?>
              <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">view all comment</h3>

              </div>
              <div class="card-body">
                   
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                       <th scope="col">#Sl.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Comments</th>
                                
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>


                      <?php

                        $sql = "SELECT * FROM comments WHERE cmt_status=0 OR cmt_status=1 ORDER BY cmt_id DESC";
                        $allComments = mysqli_query($db, $sql);
                                $i = 0;
                                while( $row = mysqli_fetch_assoc($allComments) ){
                                  $cmt_id              = $row['cmt_id'];
                                  $cmt_desc            = $row['cmt_desc'];
                                  $cmt_post_id         = $row['cmt_post_id'];
                                  $cmt_author          = $row['cmt_author'];
                                  $cmt_author_email    = $row['cmt_author_email'];
                                 $cmt_status          = $row['cmt_status'];
                                  $cmt_date            = $row['cmt_date'];
                                 
                                  $i++;

                        ?>
                        <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td>

                         <?php 

                         $sql = "SELECT * FROM post WHERE post_id = '$cmt_post_id'";

                         $post_title_by_id = mysqli_query($db, $sql);
                         while ($row = mysqli_fetch_assoc($post_title_by_id)) {
                         	
                         	$post_id   =    $row['post_id'];
                         	$title     =    $row['title'];

                         	echo $title; //title print hoy na
                         }



                         ?>
                          
                        </td>
                        <td><?php echo $cmt_author; ?></td>
                        <td><?php echo $cmt_author_email; ?></td>
                        <td><?php echo $cmt_desc; ?></td>
                        
                        <td>
                          <?php
                           if ($cmt_status == 1) {?>
                           <span class="badge badge-success">Published</span>  
                         <?php  }
                           else if ($cmt_status == 0 ) { ?>
                            <span class="badge badge-primary">Draft</span>  
                          <?php  }
                          else if ($cmt_status == 3 ) { ?>
                            <span class="badge badge-danger">Deleted</span>  
                          <?php  }


                          ?></td>
                        
                        
                        <td><?php echo $cmt_date; ?></td>
                        <td>
                          <a class="btn btn-info btn-sm" href="comments.php?do=Edit&edit=<?php echo $cmt_id; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $cmt_id; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>


                          <div class="modal fade" id="delete<?php echo $cmt_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Comment ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="delete-option text-center">
                                  <ul>
                                    <li><a href="comments.php?do=Delete&delete=<?php echo $cmt_id; ?>"class="btn btn-danger">Delete</a></li>
                                   <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li> 
                                  </ul>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        </td>
                      </tr>

                       <?php }

                      ?>
                                               
                    </tbody>
                    </table>
              </div>
             
            </div>
            </div>
         
       <?php  }
        
        else if ($do == 'Edit') { 

            if (isset($_GET['edit'])) {
              $the_comment_id = $_GET['edit'];

              $sql = "SELECT * FROM comments WHERE cmt_id= '$the_comment_id'";
              $readUser = mysqli_query($db, $sql);

              while ($row = mysqli_fetch_assoc($readUser)) {

                       $cmt_id              = $row['cmt_id'];
                       $cmt_status          = $row['cmt_status'];

                        ?>

                         <div class="col-lg-12">
                        <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Update comments </h3>

                        
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                             <form action="comments.php?do=Update" method="POST" enctype="multipart/form-data">

                             	 <div class="form-group">
                            <label>User Role</label>
                            <select name="cmt_status" class="form-control">
                              <option>Please Select comment status</option>
                              <option value="1" <?php if ( $cmt_status == 1){echo 'selected';} ?> >published</option>
                              <option value="2" <?php if ( $cmt_status == 0){echo 'selected';} ?> >Draft</option>
                              <option value="3" <?php if ( $cmt_status == 3){echo 'selected';} ?> >Deleted</option>
                              
                            </select>
                            
                          </div>
                          <div class="form-group">
                            <input type="hidden" name="cmt_id" value="<?php echo $cmt_id;?> ">
                            <input type="submit" name="updateUser" class="btn btn-block btn-primary btn-flat" value="Save Change">
                            
                          </div>
                           </form>
                                           
                          </div>
                           
                          </div>
  
                      </div>
                     
                    </div>
                    </div>

                        <?php
                
              }

            }

          }


           
        else if ($do == 'Update') {
         //update start
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                 $update_comment_id =$_POST['cmt_id'];
                 $cmt_status        = $_POST['cmt_status'];

                 $query = "UPDATE comments SET cmt_status = '$cmt_status' WHERE cmt_id = '$update_comment_id'";
                 $update_comment_status = mysqli_query($db,$query);

                 if (!$update_comment_status) {

                 	die("query faild".mysqli_error($db));
                 }
                 else{
                 	header("Location:comments.php?do=Manage");
                 }         

              }
              ?>

          		</div>
          		</div>
          		</div>
          		</div>

          		<?php }

        else if ($do == 'Delete') {
         if (isset($_GET['delete'])) {

           $the_delete_comment_id = $_GET['delete'];

           $query = "UPDATE comments SET cmt_status = 0 WHERE cmt_id = '$the_delete_comment_id'";
           $update_comment_status = mysqli_query($db,$query);
       
              
                  if (!$update_comment_status) {
                  	 die("Mysqli query failed".mysqli_error($db));
                    
                  }
                  else{
                    header("Location:comments.php?do=Manage");
                   
                 }
          
        }
           
         }

        ?>  
          
         </div>
       </div>
        <!-- /.row (main row) -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php
    include "inc/footer.php";
?>
  <!-- Control Sidebar -->
  <?php
    include "inc/sidebar.php";
?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
    include "inc/script.php";
?>


 <!-- <div class="card">
        <div class="card-header">
          <h3 class="card-title">Manage All User</h3>

          
        </div>
        <div class="card-body">
          
        
          
             

        </div>
       
      </div> -->