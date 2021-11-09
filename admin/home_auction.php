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
	<title>MANAGE AUCTIONS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"  >

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Data table -->
	<link href=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap4.min.css rel=stylesheet>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>

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
			width: 890px;
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
		
			<a class="nav-link menuItem" href="home_product.php">Manage Products</a>

			<a class="nav-link menuItem" href="home_brand.php">Manage Brands</a>
		
			<a class="nav-link menuItem" href="home_types.php">Manage Types</a>

			<a style="background-color: lightgrey" class="nav-link menuItem" href="home_auction.php">Manage Auction</a>
		</div>

		<!-- Phan Content -->
		<div id="content">
			<a class="nav-link" href="add_auction.php"> ADD New Auction</a>
			<table id ='myTable' class="table table-bordered" style="text-align: center;">
				<thead>
					<tr>
						<td style="width: 20px">ID</td>
						<td style="width: 150px">Title</td>
						<td>Location</td>
						<td>Time</td>
						<td>Description</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead> 
			<!-- Lay san pham va hien thi o day -->
				<?php
					/*Ket noi va datbase*/
					require_once("connect.php");
					/*Lay du lieu*/

					/*chuan bi SQL*/
					$sql = "SELECT * FROM auction";

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
									/*Anh va ten*/
									echo "<td>".$row['title']."</td>";
									echo "<td>".$row['location']."</td>";
									echo "<td>".$row['time']."</td>";
									echo "<td>".$row['description']."</td>";
									echo "<td>".$row['status']."</td>";
									/*Sua Xoa*/
									echo "<td>";
										$id_auction = $row['id'];
										echo "<a href = 'edit_auction.php?id=$id_auction'>Edit</a>";
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