<?php
/*Kiem tra admins login hay chua , neu chua => quay lai login*/
session_start();
if(isset($_SESSION['admins']['id']) == false){
	header("Location:login.php");
	die();
}
?>

<?php 
if(isset($_GET['id'])){
	$id_invoice = $_GET['id'];
}
require_once("connect.php");
// Xử lý thêm ảnh sản phẩm tại đây
if(isset($_POST['btnInsert'])){
	$status = $_POST['product_status'];
	$sql = "UPDATE invoices SET  status ='$status' WHERE id = '$id_invoice'";
	// Thực thi -> thành công -> chuyển về list-product
	$result = mysqli_query($conn,$sql);
	if($result == false){
		die("Lỗi: ".mysqli_error($conn));
	}
	else{
		// In sert thành công
		header("Location:home_invoice.php");
		die();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update status</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- Bat dau vao phan chinh giao dien -->
	<style type="text/css">
	*{
			margin:0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			background-color: antiquewhite;
		}

		.container{
			background-color: white;
			height: 100vh;
			padding: 0;
			overflow: auto;
			border-right: 1px solid;
			border-bottom: 1px solid;
			border-left: 1px solid ;
			margin-bottom: 5px;
			
		}

		#header{
			height: 10vh;
			padding-left: 16px;
			padding-right: 16px;
			border-bottom: 1px solid;
		}

		#menu{
			width: 20%;
			/*height: 90vh;*/
			height: auto;
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
			width: auto;
			height: 90vh;
			float: left;
			padding: 8px;
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

			<a style="background-color: lightgrey" class="nav-link menuItem" href="home_invoice.php">Manage Bills</a>
		
			<a class="nav-link menuItem" href="home_product.php">Manage Products</a>

			<a  class="nav-link menuItem" href="home_brand.php">Manage Brands</a>
		
			<a class="nav-link menuItem" href="home_types.php">Manage Types</a>

			<a class="nav-link menuItem" href="home_auction.php">Manage Auction</a>
	
		</div>

		<div id="content">
			<h2 style="text-align: center; font-family: 'News time Roman';">Update Status for this Bill ID: <?php echo $id_invoice; ?>!</h2>
				<form method="POST" enctype="multipart/form-data">

				  	<div class="form-group">
					    <label for="product_status">Status</label>
					    <select class="form-control" name="product_status" id="product_status" required>
					    	<option value="0">Wait to Approved</option>
					    	<option value="1">Approved</option>
					    	<option value="-1">Canceled</option>
					    </select>	
				  	</div>
	  				<button name="btnInsert" type="submit" class="btn btn-primary">Submit</button>
				</form>
		</div>
	</div>
	
</body>
</html>
	