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
    <?php 
    	include 'connect.php';
      $errClassName = $errClassPrice = '';
      $errTextName = $errTextPrice = '';
      $name = $price = '';
      if (isset($_POST['product'])) {
        $name  = $_POST['name'];
        $price = $_POST['price'];
        $describe = $_POST['describe'];
        $datecreate = $_POST['datecreate'];
        // chuyen dinh dang bithday sang Nam-thang-ngay
        $datecreate = date("Y-m-d", strtotime($datecreate));
        $image = 'default.png';

        if ($name == '') {
          $errClassName = 'has-error';
          $errTextName = 'Please input your name';
        }
        if ($name != '' && $price != '') {
          //upload image
          if ($_FILES['image']['error'] == 0) {
            $image = uniqid().'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/image/'.$image);
          }
          //
        	$sql = "INSERT INTO product(name, price, describe, image, datecreate) VALUES ('$name', '$price', '$describe', '$image', '$datecreate')";
        	if (mysqli_query($connect, $sql) === TRUE) {
        		// chuyen trang trong PHP
        		header("Location: list_product.php");
        	}
        }
      }
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Register form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="#" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group <?php echo $errClassName;?>">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="exampleInputName" placeholder="Enter name" name="name" value="<?php echo $name;?>">
                  <span class="help-block"><?php echo $errTextName;?></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Price">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Describe</label>
                  <input type="text" name="describe" class="form-control" id="exampleInputPhone" placeholder="Describe">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                  <input type="file" name="image" id="exampleInputFile">
                </div>
              <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="datecreate" class="form-control pull-right" id="datecreate">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="product">ADD</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'common/footer.php';?>