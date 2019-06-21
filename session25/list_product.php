<?php include 'common/header.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	    <?php
	    	include 'connect.php';
	    	$sql = "SELECT * FROM product";
	    	$result = mysqli_query($connect, $sql);
	    ?>
	     <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Describe</th>
                  <th>Image</th>
                  <th>Date</th>
                </tr>
               <?php 
               if ($result->num_rows > 0) {
               	while($row = $result->fetch_assoc()) {
               		$id = $row['name'];
               ?>
	                <tr>
	                  <td><?php echo $row['name']?></td>
	                  <td>
	                    <?php echo $row['price']?>
	                  </td>
                    <td><?php echo $row['describe']?></td>
                    <td><?php echo $row['datecreate']?></td>
                    <td><img src="uploads/image/<?php echo $row['image']?>" alt="image" class="image_product"></td>
	                  <td><a href="edit_user.php?name=<?php echo $id?>">Edit</a> | <a href="delete_user.php?name=<?php echo $id?>">Delete</a></td>
	                </tr>
                <?php 
                	}
                } else {?>
                <tr>
                	<td colspan="4">Khong co user nao</td>
                </tr>
                <?php }?>
              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'common/footer.php';?>