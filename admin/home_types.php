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
	<title>MANAGE TYPES</title>
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

			<a class="nav-link menuItem" href="home_invoice.php">Manage Bills</a>
		
			<a  class="nav-link menuItem" href="home_product.php">Manage Products</a>

			<a class="nav-link menuItem" href="home_brand.php">Manage Brands</a>
		
			<a style="background-color: lightgrey" class="nav-link menuItem" href="home_types.php">Manage Types</a>

			<a class="nav-link menuItem" href="home_auction.php">Manage Auction</a>
	
		</div>

		<!-- Content -->
		<div id = "content">
			<table id ='myTable' class="table table-bordered" style="text-align: center;">
				<thead>
					<tr>
						<td>ID Type</td>
						<td>Name</td>
						<td>Action</td>
					</tr>
				</thead> 
				<?php
					/*Ket noi va datbase*/
					require_once("connect.php");
					/*Lay du lieu*/

					/*chuan bi SQL*/
					$sql = "SELECT id,name FROM types";

					$result = mysqli_query($conn,$sql);

					if($result == false){
						die("ERROR".mysqli_error($conn));
					}
					else{
						/*In ra san pham*/
						if(mysqli_num_rows($result)>0){
							while ($row = mysqli_fetch_assoc($result)){
								echo "<tr>";
									/*ID*/
									echo "<td>".$row['id']."</td>";
									/*Tten*/
									echo "<td>".$row['name']."</td>";
									/*Xoa*/
									echo "<td>";
										$id_types = $row['id'];
										echo "<a href = 'delete_types.php?id=$id_types'>Delete</a>";
									echo "</td>";
								echo "</tr>";
							}
						}
					}
				?>


			</table>
		</div>
	</div>
</body>
</html>
