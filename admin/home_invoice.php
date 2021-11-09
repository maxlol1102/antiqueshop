<?php
/*Kiem tra admins login hay chua , neu chua => quay lai login*/
session_start();
if(isset($_SESSION['admins']['id']) == false){
	header("Location:login.php");
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MANAGE BILLS</title>
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

				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th>ID Bill</th>
							<th>Order date</th>
							<th>Reciver Infomation</th>
							<th>Total Price</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php 
						// In ra danh sách hoá đơn 
						$sql = "SELECT * FROM invoices";
						// Thực thi
						require_once('connect.php');
						$result = mysqli_query($conn,$sql);

						if($result == false){
							die("Lỗi: ".mysqli_error($conn));
						}
						else{
							if(mysqli_num_rows($result) == 0){
								echo "<h2>EMPTY LIST</h2>";
							}
							else{
								// In ra toàn bộ hoá đơn
								while($row = mysqli_fetch_assoc($result)){
									// Cần kiểm tra lại khi khách đặt hàng
									echo "<td>".$row['id']."</td>";
									echo "<td>".$row['created_at']."</td>";
									echo "<td>". $row['receiver']."--".$row['phone']."--".$row['address']."</td>";
									echo "<td>"."$".$row['total_amount'].".00"."</td>";
									echo "<td>".$row['status']."</td>";

									echo "<td>";
										$id_invoice = $row['id'];
										echo "<a href = 'update_status.php?id=$id_invoice'>Update</a>";
									echo "</td>";
								}

							}
						}

					 ?>
				</table>
			</div>
		</div>
</body>
</html>
	