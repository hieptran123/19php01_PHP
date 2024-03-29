<?php include 'common/header.php';   ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Product</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
<div class="form">
<h1>Edit the product</h1>
  <?php 
      include 'connect.php';
      // lay thong tin cu cua user can edit
      $id = $_GET['id'];
      $sql = "SELECT * FROM products WHERE id = $id";
      $editProduct = mysqli_query($connect, $sql);
      $row = $editProduct->fetch_assoc();
      $errClassNameProduct = $errClassPriceProduct = $errClassDescriptedProduct = $errClassImage = $errClassDay = '';
      $errTextNameProduct = $errTextPriceProduct = $errTextDescriptedProduct = $errTextImage = $errTextDay = '';
      $nameProduct = $priceProduct = $description = $imageDe = $datePro = '';
      if (isset($_POST['editProduct'])) {
        $NameProduct  = $_POST['NameProduct'];
        $PriceProduct = $_POST['PriceProduct'];
        $description = $_POST['description'];
        $datePro = $_POST['datePro'];
        $datePro = date("Y-m-d", strtotime($datePro));
        $image = 'default.png';
        if ($NameProduct == '') {
          $errClassNameProduct = 'has-error';
          $errTextNameProduct = 'Please input name product';
        }
        if ($PriceProduct == '') {
          $errClassPriceProduct = 'has-error';
          $errTextPriceProduct = 'Please input price product';
        }
        if ($description == '') {
          $errClassDescriptedProduct = 'has-error';
          $errTextDescriptedProduct = 'Please input the description ';
        }
         if($image == '') {
          $errClassImage = 'has-error';
          $errTextImage = 'Please input your avatar';
        }
        if ($datePro == '') {
          $errClassDay = 'has-error';
          $errTextDay = 'Please input date';
        }
        if($NameProduct != '' && $PriceProduct != '' && $description != '' && $image != '' && $datePro != ''){
          if ($_FILES['image']['error'] == 0) {
            $imageDe = uniqid().'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/products/'.$image);
          }
           $sql = "UPDATE products SET NameProduct = '$NameProduct', PriceProduct = '$PriceProduct', description = '$description', datePro = '$datePro' WHERE id = '$id'";
          if(mysqli_query($connect, $sql) === TRUE){
            header("Location: list_product.php");
            
          }

        }
      }


     ?>
     <section class="content">
      <div class="row">
       <div class="col-md-12">
         <div class="box box-primary">
           <div class="box-header with-border">
             <h3 class="box-title">Add product</h3>
           </div>
           <form role = 'form' action="#" method="POST" enctype="multipart/form-data">
            <div class="box-body">
              <!-- Input name of product -->
                <div class="form-group <?php echo $errClassNameProduct;?>">
                  <label for="exampleInputEmail1">Name Product</label>
                  <input type="text" class="form-control" id="exampleInputNameProduct" placeholder="name product" name="nameProduct"  required value="<?php echo $row['nameProduct'];?>">
                  <span class="help-block"><?php echo $errTextNameProduct;?></span>
                </div>
                <!-- input price of product -->
                <div class="form-group <?php echo $errClassPriceProduct;?>">
                  <label for="exampleInputEmail1">Price Product</label>
                  <input type="text" class="form-control" id="exampleInputPriceProduct" placeholder="price" name="priceProduct" value="<?php echo $row['priceProduct'];?>">
                  <span class="help-block"><?php echo $errTextPriceProduct;?></span>
                </div>
                <!-- input the description -->

                 <div class="form-group <?php echo $errClassDescriptedProduct;?>">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control boxDescription" id="exampleInputDecriptedProduct" placeholder="description" name="description" height=700px  value="<?php echo $row['description'];?>">
                  <span class="help-block"><?php echo $errTextDescriptedProduct;?></span>
                </div>

                <!-- Image -->
                 <div class="form-group <?php echo $errClassImage ?>">
                  <label for="exampleInputFile">Image</label>
                  <input type="file" id="exampleInputFile" name="imageDe" value="<?php echo $row['imageDe'] ?>">
                  <span class="help-block"><?php echo $errTextImage;?></span>
                </div>
                <!-- date -->
              <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="datePro" value="<?php echo $row['datePro']  ?>" class="form-control pull-right" id="birthday">
                </div>
                <span class="help-block"><?php echo $errTextDay;?></span>
                <!-- /.input group -->
              </div>



              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="editProduct">update</button>
              </div>
           </form>
         </div>
       </div> 
      </div>
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->



  

  <?php include 'common/footer.php';?>
  </body>
  </html>