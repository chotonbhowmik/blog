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
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Category</li>
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
        <!--left side--->
         <div class="col-lg-6">
          <!--add new category start-->
            <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add New Category</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
         
             <form action="" method="POST">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" autocomplete="off" required="required">
              </div>

              <div class="form-group">
                <label>Description</label>
                 <textarea class="form-control" name="desc"></textarea>
              </div>

              <div class="form-group">
                <label>Primary Category</label>
                 <select class="form-control" name="is_parent">
                   <option value="1">Please select the primary category</option>

                   <?php
                    $query = "SELECT * FROM category WHERE is_parent = 0";
                        $primary_category = mysqli_query($db, $query);
                        while ($row  = mysqli_fetch_assoc($primary_category)) {

                            $cat_id   =  $row['cat_id'];
                            $cat_name =  $row['cat_name'];
                            ?>
                            <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>

                       <?php   }

                   ?>
                   
                   
                 </select>
              </div>

              <div class="form-group">
                <label>Status</label>
                 <select class="form-control" name="status">
                   <option value="1">Please select the category status</option>
                   <option value="1">Active</option>
                   <option value="0">Inactive</option>
                 </select>
              </div>
              <div class="form-group">
                <input type="submit"  name="addCategory" value="Add New Category" class="btn btn-block btn-primary btn-flat">
                
              </div>
               

             </form>

        </div>
        <!-- /.card-body -->
      </div>
          <!----add new category end--->

          <?php
              //register new category
          if (isset($_POST['addCategory'])) {

              $name      =   $_POST['name'];
              $desc      =   $_POST['desc'];
              $is_parent =   $_POST['is_parent'];
              $status    =   $_POST['status'];

              $sql = "INSERT INTO category (cat_name, cat_desc, is_parent, status) VALUES ('$name', '$desc', '$is_parent', '$status')";
              $AddSuccess = mysqli_query($db, $sql);
              if ($AddSuccess) { 
              
             $_SESSION['message']     = "New Category Added Successfully";
                
              header("Location:category.php");

              }
              else{
                 $_SESSION['message']     = "Please Fill Up The Information Perfectly";
                die("database not connected ".mysqli_error($db));
              }
          }

          ?>
           
         </div>
          <!--right side--->
         <div class="col-lg-6">

             <?php
               if (isset($_GET['edit'])) {

                 $editId = $_GET['edit'];
                 $sql = "SELECT * FROM category WHERE cat_id = '$editId'";
                 $editCat = mysqli_query($db, $sql);
                  while ($row = mysqli_fetch_assoc($editCat)) {
                   $cat_id     =    $row['cat_id'];
                   $cat_name   =    $row['cat_name'];
                   $cat_desc   =    $row['cat_desc'];
                   $is_parent  =    $row['is_parent'];
                   $status     =    $row['status'];
                   ?>

        
  <div class="card">
        <div class="card-header">
          <h3 class="card-title">Update Category</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
         
             <form action="" method="POST">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" autocomplete="off" required="required" value="<?php echo $cat_name;?> ">
              </div>

              <div class="form-group">
                <label>Description</label>
                 <textarea class="form-control" name="desc"><?php echo $cat_desc;?></textarea>
              </div>
                 <div class="form-group">
                <label>Primary Category</label>
                 <select class="form-control" name="is_parent">
                   <option value="0">Please select the primary category</option>

                   <?php
                    $query = "SELECT * FROM category WHERE is_parent=0";
                        $primary_category = mysqli_query($db, $query);
                        while ($row  = mysqli_fetch_assoc($primary_category)) {

                            $editPrimaryCategoryId   =  $row['cat_id'];
                            $cat_name =  $row['cat_name'];
                            ?>
                            <option value="<?php echo $editPrimaryCategoryId; ?>" <?php 
                           if ($editPrimaryCategoryId == $is_parent) {
                              echo 'selected';
                            } ?>><?php echo $cat_name; ?></option>

                       <?php   }

                   ?>
                   
                   
                 </select>
              </div>

              <div class="form-group">
                <label>Status</label>
                 <select class="form-control" name="status">
                   <option value="1">Please select the category status</option>
                   <option value="1" <?php if( $status == 1){
                    echo 'selected'; } ?> >Active</option>
                   <option value="0" <?php if( $status == 0){
                    echo 'selected'; } ?> >Inactive</option>
                 </select>
              </div>
              <div class="form-group">
                <input type="hidden" name="updateId" value="<?php echo $cat_id;?>">
                <input type="submit" name="updateCategory" value="Save Changes" class="btn btn-block btn-primary btn-flat">
                
              </div>
               

             </form>

        </div>
        <!-- /.card-body -->
      </div>


              <?php  }
             }

             ?>

             <?php
             //update category info
                    if (isset($_POST['updateCategory'])) {
                      $name            = $_POST['name'];
                      $desc            = $_POST['desc'];
                      $is_parent       = $_POST['is_parent'];
                      $status          = $_POST['status'];
                      $updateId        = $_POST['updateId'];
                      $sql = "UPDATE category SET cat_name='$name', cat_desc='$desc', is_parent='$is_parent', status='$status' WHERE cat_id = '$updateId '";

                         $updateSuccess = mysqli_query($db, $sql);
                        if ($updateSuccess) {
                          header("Location:category.php");
                        }
                        else{
                          die("database not connected ".mysqli_error($db));
                        }

                              }
                          
                       ?>



          <!---all category start---------->
          <div class="card">
        <div class="card-header">
          <h3 class="card-title">Manage All Category</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%">
                          #SL.
                      </th>
                      <th style="width: 20%">
                          Category Name
                      </th>
                      <th style="width: 25%">
                         Primary Category
                      </th>

                      <th style="width: 20%">
                          Status
                      </th>
                      
                      <th style="width: 30%">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php
                       $sql = "SELECT * FROM category";
                       $allCat = mysqli_query($db, $sql);
                       $i = 0;

                       while ($row = mysqli_fetch_assoc($allCat)) {
                       $cat_id     =    $row['cat_id'];
                       $cat_name   =    $row['cat_name'];
                       $cat_desc   =    $row['cat_desc'];
                       $is_parent  =    $row['is_parent'];
                       $status     =    $row['status'];
                       $i++;

                       ?>
                           <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $cat_name; ?></td>
                      <td>
                        <?php
                        if ($is_parent == 0) { ?>
                          <div class="badge badge-primary">primary category</div>
                          
                      <?php  }
                      else{

                        $query = "SELECT * FROM category WHERE cat_id = '$is_parent'";
                        $primary_cat = mysqli_query($db, $query);
                        while ($row  = mysqli_fetch_assoc($primary_cat)) {

                            $p_cat_id   =  $row['cat_id'];
                            $cat_name =  $row['cat_name'];
                          
                            ?>
                            <div class="badge badge-success"><?php echo $cat_name; ?></div>
                     <?php   }

                      }



                        ?>
                      </td>
                      <td>
                        <?php
                               if ($status == 0) {?>
                                <span class="badge badge-danger">Inactive</span>
                              <?php  }
                               else if ($status == 1) {?>
                                 <span class="badge badge-success">Active</span>
                             <?php  }
                        ?>



                      </td>
                        <td class="project-actions">
                          <!-- <a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a> -->
                          <a class="btn btn-info btn-sm" href="category.php?edit=<?php echo $cat_id; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                  <!--Delete  Modal -->
                  <div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this category?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="delete-option text-center">
                            <ul>
                              <li><a href="category.php?delete=<?php echo $cat_id; ?>"class="btn btn-danger"  >Delete</a></li>
                             <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li> 
                            </ul>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  

                   <?php    }

                ?>
                  
                  
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
          <!--all category end----->





           
         </div>
       </div>
        
      </div>
    </section>
    
  </div>

  <?php
  //delete category query

     if ( isset( $_GET['delete'] ) ) {
          $delete_id = $_GET['delete'];
          

          $sql = "DELETE FROM category WHERE cat_id = '$delete_id' ";
         
          $delete_query = mysqli_query($db, $sql);
          
          if ( $delete_query ) { ?>
            <script type="text/javascript">
  
  function danger(){
    toastr.danger('New Category Added Successfully');
  }

</script>
            <?php

            header("Location: category.php");
          }
          else{
            die("delete failed ." .mysqli_error($db));
          }

     }

  ?>
 
 
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
