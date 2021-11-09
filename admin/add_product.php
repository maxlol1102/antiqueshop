<?php
/*Kiem tra admins login hay chua , neu chua => quay lai login*/
session_start();
if(isset($_SESSION['admins']['id']) == false){
	header("Location:login.php");
	die();
}
?>

<?php 
	// Xử lý thêm ảnh sản phẩm tại đây
	if(isset($_POST['btnInsert'])){
		$name = $_POST['product_name'];
		// $image = $_POST['product_image'];
		$price = $_POST['product_price'];
		$description = $_POST['product_description'];
		$status = $_POST['product_status'];

		// Xử lí thêm ảnh
		$folder = '../images/';

		$file = $_FILES['product_image'];

	    // ĐƯờng dẫn ảnh
		$image = $folder.$file['name'];

		// Di chuyển ảnh từ thư mục tam thời về đường dẫn trên
		move_uploaded_file($file['tmp_name'], $image);

		$sql = "INSERT INTO products VALUES(NULL,'$name','$price','$image','$description','$status',NULL,NULL)";

	    require_once("connect.php");
		// Thực thi -> thành công -> chuyển về list-product
		$result = mysqli_query($conn,$sql);
		if($result == false){
			die("Lỗi: ".mysqli_error($conn));
		}
		else{
			// In sert thành công
			header("Location:home_product.php");
			die();
		}
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>ADD PRODUCT</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- Bat dau vao phan chinh giao dien -->
	<style type="text/css">
		body{
			background-color: antiquewhite;
		}

		.container{
			background-color: white;
			height: 100vh;
			padding: 0;
			overflow: auto;
			border-right: 1px solid grey;
			border-left: 1px solid grey;
		}

		#header{
			height: 10vh;
			padding-left: 16px;
			padding-right: 16px;
			border-bottom: 1px dotted lightgrey;
		}

		#menu{
			width: 20%;
			height: 90vh;
			float: left;
			border-right: 1px solid;
		}

		.menuItem{
			height: 80px;
			vertical-align: middle;
			padding:25px;
			display: block;
			border-bottom: 1px solid grey;
		}

		.menuItem:hover{
			background-color: lightgrey;
		}

		.menuItem:active{
			color: red;
		}

		#content{
			width: 80%;
			height: 90vh;
			float: left;
			padding: 10px;
		}

	</style>
</head>
<body>
	<div class="container">
		<!-- Phan Header -->
		<div id="header">
			<a href="home.php" style="float: left;font-size: 33px;color: black;" class="nav-link">BKACAD ANTIQUES</a>
			<div id="account" style="float: right;">
				<img class="round-circle" src="" height="60px">
				<!-- In ra ten Admin -->
				<strong> <?php echo $_SESSION['admins']['name']; ?></strong>
				<!-- Nut LOGOUT -->
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<!-- Phan Menu -->
		<div id="menu">

			<a class="nav-link menuItem" href="home_invoice.php">Manage Bills</a>
		
			<a style="background-color: lightgrey" class="nav-link menuItem" href="home_product.php">Manage Products</a>

			<a class="nav-link menuItem" href="home_brand.php">Manage Brands</a>
		
			<a class="nav-link menuItem" href="home_types.php">Manage Types</a>

			<a  class="nav-link menuItem" href="home_auction.php">Manage Auction</a>
	
		</div>

		<!-- Phan Content -->
		<div id="content">
			<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
				    <label for="product_name">Product Name</label>
				    <input id="product_name" type="text" class="form-control" name="product_name" required>
			  	</div>
			  	<div class="form-group">
				    <label for="product_price">Price</label>
				    <input id="product_price" type="number" step="any" class="form-control" name="product_price" required>
			  	</div>
			  	

			  	<div class="form-group">
				    <label for="product_description">Description</label>
				    <textarea id="product_description" class="form-control" name="product_description" required></textarea>
			  	</div>
			  	<!-- Quu uoc 0- het hang, 1 - con hang, -1 - ngung kinh doanh
			  	2- hang sap ve -->

			  	<div class="form-group">
				    <label for="product_status">Status</label>
				    <select class="form-control" name="product_status" id="product_status" required>
				    	<option value="0">Out Of Stock</option>
				    	<option value="1">In-Stock</option>
				    	<option value="-1">Not Available</option>
				    	<option value="2">Importing</option>
				    </select>
				
			  	</div>

			  	<div class="form-group">
				    <label for="product_image">Image</label> <br>
				    <input id="product_image" type="file" name="product_image" required accept="image/*" required>
			  	</div>
 
  				<button name="btnInsert" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>
