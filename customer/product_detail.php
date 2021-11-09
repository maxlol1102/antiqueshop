<?php 
session_start();
// Cần lấy id của sản phẩm cần xem chi tiết
if(isset($_GET['id'])){
	$id_product = $_GET['id'];
}
else{
	header("Location:home.php");
	die();
}

$sql = "SELECT * FROM products WHERE id = '$id_product'";
require_once("connect.php");
$result = mysqli_query($conn,$sql);
if($result == false){
	die("Lỗi: ".mysqli_error($conn));
}
else{
	if(mysqli_num_rows($result) == 0){
		die("Không tồn tại sản phẩm có id: $id_product");
	}

	$row = mysqli_fetch_assoc($result);

	$image = $row['image'];
	$name= $row['name'];
	$description = $row['description'];
	$price = $row['price'];

}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo $name;  ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


	<!--BS cho footer  -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" rel="stylesheet"/>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
			font-family: Old Standard TT;
		}

		body {
		  
		}

		#header{
			height: 15vh;
			padding: 15px;
		
		}
		#logo{
			float: left;
			padding-left: 550px;
		}
		.icon_header{
			padding-top: 12px;
			float: right;
			width: 100px;
			height: 7vh;
			color: black;
		}
		#content{
			height: auto;
			width: 100%;
		/*	background-color:#e9e9e9;*/
		}
	
		a{
			text-decoration: none;
			color:black;
			margin-right: 4px;
			margin-right:4px;
		}
		a:hover{
			text-decoration: none;
			color:red;
		}
		.item-product{
			padding: 8px;
			/*border: 1px solid gray;*/
			text-align: center;
			box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
		}
		.item-product:hover{
			box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
		}
		#tbcontent table {
		    border-collapse: separate;
		    border-spacing: 1em;
		}
		#tbcontent table tr{
			background-color: white;
		}
		#tbcontent a :hover{
			background-color: black;
			color: white;
		}

		/*duong dan*/
		#duongdan{
			width:auto; 
			height:80px; 
			padding-top:26px; 
			padding-left:50px; 
			background-color:#eeeee4
		}
		#duongdan a{
			font-family:monospace; 
			font-size:19px;
		}
		#duongdan p{
			font-family:monospace; 
			font-size:19px;
		}
		/*Product description*/
		#prodes{
			width:auto;
			height: 800px;
			background-color: #E9e9e2;
		}
		#prodes p{
			padding-top: 20px;
			text-align: center;
			font-size: 20px;
			font-family: monospace;
		}
		.btn-outline-dark:hover{
			background-color: black;
			color: white;
		}

	</style>
</head>
<body>
		<!-- Banner -->
		<div style="background-color: black;color: white; text-align: center; height: 50px; width: auto; padding-top: 10px">
			<b style=" font-family: monospace; font-size: 19px;">FREE GROUND SHIPPING ON ALL US ORDERS $100+</b>
		</div>

		<!-- HEADER -->
		<div id="header">
			<div id="logo">
				<a href="home.php">
					<img src="https://scontent.xx.fbcdn.net/v/t1.15752-0/s480x480/194580260_488809879032826_2341979794773693032_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=58c789&_nc_ohc=sXJRhaIlN-EAX9zithk&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&tp=7&oh=545c90a9b95aa26fa7b973a5dd7cc2b1&oe=60DEE483" style="height: 9.5vh;width: 190px;
				align-items: center; ">
				</a>
			</div>

			<div style="float:right; width:300px;padding-top:4px ">
				<div class="icon_header">
						<a href="home.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-house" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
							  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
							</svg>
						</a>
				</div>	
				
				<div class="icon_header">
						<a href="cart.php">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-cart-plus" viewBox="0 0 16 16">
								<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
								<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>	
						</a>
				</div>
			    <?php 
				  
					if(!isset($_SESSION['customer']['id'])){
				?>
				<!-- dang nhap -->
				<div class="icon_header">
						<a href="login.php">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-person" viewBox="0 0 16 16">
								<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
								</svg>
						</a>
				</div>
				
				<?php
					}
					else{
				?>
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
					        <a style="padding-top: 19px" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					        	<span style="padding-top: 10px;"><?php echo $_SESSION['customer']['name']; ?></span>
					        </a>
					        <div class="dropdown-menu" style="padding-left: 10px; width: 20px;">
					          	<a href="logout.php" class="btn btn-outline-dark">Sign-out</a>
					        </div>
					     </li>
					</ul>
				<?php
					}
				?>			
			</div>
		</div>
		
		<!-- Duong dan -->
		<div id ="duongdan">
			<p><a href="home.php">Home</a>/ <?php echo $name;  ?></p>
		</div>
		<br>
	
		<!-- Content -->
		<div id="content">
			<!-- Phần hiển thị sản phẩm ở đây -->
			<table id='tbcontent' class='table table-bordered'>
				<tr>
					<td style="width: 500px; padding-left:65px ">
						<img src="<?php echo $image; ?>" width="400px">
					</td>

					<td>
						<p style="font-size:48px; font-weight: bold;"><?php echo $name; ?></p>
						<br>
						<p style="font-size:26px; font-family: monospace; color:grey;"> $<?php echo $price; ?>.00 </p>
						<!-- Nut add -->
						<a href="cart.php?action=add&id=<?php echo $id_product ?>">
							<button  type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark">
									Add to Cart	
							</button>
						</a>
					</td>
				</tr>
			</table>
		</div>
	

		<!-- product Description -->
		<div id="prodes">
			<p>Product Description</p>
			<hr style=" background-color: black">
			
			<div style="float: left; width: 650px; padding-left: 50px; padding-top: 200px; ">
				<p style="text-align: left; font-size: 16px;" > <?php echo $description; ?> </p>
			</div>

			<div style="float: right; padding-right:100px; padding-top:50px;">
				<img src="<?php echo $image; ?>" width="450px">
			</div>
		</div>

		<br>
		<!-- Sologan -->
		<div style="width: auto;height: 100px; text-align: center; padding: 18px; background-color:#e9e9e9; ">
			<i style="font-size: 50px "> "We alway be the best for you!" </i>
		</div> 
		<br>
		<!-- Footer -->
		<footer class="text-white text-center text-lg-start bg-dark">
			    <!-- Grid container -->
			    <div class="container p-4">
			      <!--Grid row-->
			      <div class="row mt-4">
			        <!--Grid column-->
			        <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
			          <h5 class="text-uppercase mb-4">About company</h5>

			          <p style="text-align: left;">
			            BKC-Antiques, at 1A Cau Giay Street, is a 21-room Victorian in the Gold Park style. Built in 1900, it was designed by architect N.X.Kien as a rectory. In the 1930's the convent was converted into a single-family home, then apartments.
			          </p>

			          <p style="text-align: left;">
			            Named after our Company:"BKC-Company", BKC-Company balances the history of our country by combining hand-made art and decor from all VN villages with mid century modern and contemporary pieces.
			          </p>

			          <div class="mt-4">
			            <!-- Facebook -->
			            <a  id="iconn" type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-facebook-f"></i></a>
			            <!-- Twitter -->
			            <a  id="iconn" type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-twitter"></i></a>
			            <!-- Google + -->
			            <a  id="iconn" type="button" class="btn btn-floating btn-light btn-lg"><i class="fab fa-google-plus-g"></i></a>

			          </div>
			        </div>
		

			        <!--Grid column-->
			        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
			          <h5 class="text-uppercase mb-4 pb-1">Contact us</h5>

			          <hr>


			          <ul class="fa-ul" >
			            <li class="mb-3">
			              <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Ha Noi, 10000, Viet Nam</span>
			            </li>
			            <li class="mb-3">
			              <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">caonguyenvu2016@gmail.com</span>
			            </li>
			            <li class="mb-3">
			              <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">0983079271</span>
			            </li>
			          </ul>
			        </div>
			        <!--Grid column-->

			        <!--Grid column-->
			        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
			          <h5 class="text-uppercase mb-4">Opening hours</h5>

			          <table id="opening"class="table text-center text-white" >
			            <tbody class="fw-normal" >
			              <tr>
			                <td>Mon - Thu:</td>
			                <td>8am - 9pm</td>
			              </tr>
			              <tr>
			                <td>Fri - Sat:</td>
			                <td>8am - 1am</td>
			              </tr>
			              <tr>
			                <td>Sunday:</td>
			                <td>9am - 10pm</td>
			              </tr>
			            </tbody>
			          </table>
			        </div>
			        <!--Grid column-->
			      </div>
			      <!--Grid row-->
			    </div>
			    <!-- Grid container -->

			    <!-- Copyright -->
			    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
			      © 2020 Copyright:
			      <a class="text-white">BKC-Antiques</a>
			    </div>
			    <!-- Copyright -->
		</footer>

</body>
</html>