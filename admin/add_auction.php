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
		
		$title = $_POST['auction_title'];
		$location = $_POST['auction_location'];
		$time = $_POST['auction_time'];
		$description = $_POST['auction_description'];
		$status = $_POST['auction_status'];


		$sql = "INSERT INTO auction VALUES(NULL,'$title','$location','$time','$description','$status')";

	    require_once("connect.php");
		// Thực thi -> thành công -> chuyển về list-product
		$result = mysqli_query($conn,$sql);
		if($result == false){
			die("Lỗi: ".mysqli_error($conn));
		}
		else{
			// In sert thành công
			header("Location:home_auction.php");
			die();
		}
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>ADD AUCTION</title>
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
		
			<a class="nav-link menuItem" href="home_product.php">Manage Products</a>

			<a class="nav-link menuItem" href="home_brand.php">Manage Brands</a>
		
			<a class="nav-link menuItem" href="home_types.php">Manage Types</a>

			<a style="background-color: lightgrey" class="nav-link menuItem" href="home_auction.php">Manage Auction</a>
	
		</div>

		<!-- Phan Content -->
		<div id="content">
			<h2 style="text-align: center;">Create new Auction</h2>
			<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
				    <label for="auction_title">Auction Title</label>
				    <input id="auction_title" type="text" class="form-control" name="auction_title" required>
			  	</div>

			  	<div class="form-group">
				    <label for="location">Location</label>
				    <input id="location" type="text" class="form-control" name="auction_location" required>
			  	</div>
			  	
			  	<div class="form-group">
				    <label for="time">Date-time: </label>
				    <input id="time" type="datetime-local"  value="<?php echo date('Y-m-d\TH:i:sP', $row['Time']); ?>" class="form-control" name="auction_time" required>
			  	</div>

			  	<div class="form-group">
				    <label for="auction_description">Description</label>
				    <textarea id="auction_description" class="form-control" name="auction_description" ></textarea>
			  	</div>
			  	<!-- Quu uoc 0- het hang, 1 - con hang, -1 - ngung kinh doanh -->

			  	<div class="form-group">
				    <label for="auction_status">Status</label>
				    <select class="form-control" name="auction_status" id="auction_status" required>
				    	<option value="0">Coming-soon</option>
				    	<option value="1">On-going</option>
				    	<option value="-1">Closed</option>
				    </select>
				
			  	</div>
 
  				<button name="btnInsert" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>
