<?php 
// Nếu chưa đăng nhập -> đăng nhập
session_start();
if(!isset($_SESSION['customer']['id'])){
    header("Location:login.php");
    die();
}

// Người dùng nhập thông tin -> tạo hoá đơn
if(isset($_POST['btn_Checkout'])){
    $receiver = $_POST['receiver'];
     $address = $_POST['address'];
     $phone = $_POST['phone'];
   

    // Kết nối DB 
    require_once('connect.php');
    $total = $_SESSION['total_amount'];
    // Quy ước về trạng:
    // 0 - chưa duyệt, 1 đã duyệt , -1 huỷ.
    $id_customer = $_SESSION['customer']['id'];
    $sql = "INSERT INTO invoices VALUES (NULL,current_timestamp(),'$total','$receiver','$address','$phone',0,NULL,'$id_customer')";
 
    // Thực thi
    $result = mysqli_query($conn,$sql);
    if($result == false){
        die("Error: ".mysqli_error($conn));
    }
    else{
        // Lấy ra id invoice vừa thêm thành công 
        $id_invoice = mysqli_insert_id($conn);

        // Thêm vào hoá đơn chi tiết
        foreach($_SESSION['cart'] as $id_product => $quantity){
            $sql = "INSERT INTO invoicedetails VALUES ('$id_invoice','$id_product','$quantity')";
            $result = mysqli_query($conn,$sql);
            if($result == false) die('Error: '.mysqli_error($conn));
        }

        // Sau khi thêm thành công
        unset($_SESSION['cart']);
        //  Hoá dơn 
        header("Location:checkout_success.php?id=$id_invoice");
        die();
    }

}
		/*Tu dien ten neu dang nhap roi*/
      	$receiver = $address = $phone = "";
      	if(isset($_SESSION['customer'])){
    		$id_customer = $_SESSION['customer']['id'];
      		$sql="SELECT * FROM customer WHERE id='$id_customer'";
      		  require_once('connect.php');
      		$result = mysqli_query($conn,$sql);
      		 if(mysqli_num_rows($result)== 1) {
      			$row = mysqli_fetch_assoc($result);
      			$receiver = $row['name'];
      			$address = $row['address'];
      			$phone = $row['phone_no'];
      		}
      	}
    

?>

<!DOCTYPE html>
<head>
	<title>Check out</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- BS cho slide -->
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<!--BS cho footer  -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
	

	<style>
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
		
		
		/*phan content*/
		.row {
		  display: -ms-flexbox; /* IE10 */
		  display: flex;
		  -ms-flex-wrap: wrap; /* IE10 */
		  flex-wrap: wrap;
		  margin: 0 20px;
		}

		.col-25 {
		  -ms-flex: 25%; /* IE10 */
		  flex: 25%;
		}

		.col-50 {
		  -ms-flex: 50%; /* IE10 */
		  flex: 50%;
		}

		.col-75 {
		  -ms-flex: 75%; /* IE10 */
		  flex: 75%;
		}

		.col-25,
		.col-50,
		.col-75 {
		  padding: 0 16px;
		}

		.container {
		  background-color: #f2f2f2;
		  padding: 5px 20px 15px 20px;
		  border: 1px solid lightgrey;
		  border-radius: 3px;
		}

		input[type=text] {
		  width: 100%;
		  margin-bottom: 20px;
		  padding: 12px;
		  border: 1px solid #ccc;
		  border-radius: 3px;
		}

		label {
		  margin-bottom: 10px;
		  display: block;
		}

		.icon-container {
		  margin-bottom: 20px;
		  padding: 7px 0;
		  font-size: 24px;
		}

		.btn {
		  background-color: black;
		  color: white;
		  padding: 12px;
		  margin: 10px 0;
		  border: 1px solid black;
		  width: 100%;
		  border-radius: 3px;
		  cursor: pointer;
		  font-size: 18px;
		}

		.btn:hover {
		  background-color:white;
		  color: black;
		}

		a {
		  color: #2196F3;
		}

		hr {
		  border: 1px solid lightgrey;
		}

		span.price {
		  float: right;
		  color: grey;
		}

		/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
		@media (max-width: 800px) {
		  .row {
		    flex-direction: column-reverse;
		  }
		  .col-25 {
		    margin-bottom: 20px;
		  }
		}
		/*Phan sua footer*/
		#opening tr td{
			background-color: #343A40;
		}
		#iconn{
			background-color: #343A40;
			width: 60px;
		}
		#iconn:hover{
			background-color: white;
			color: #343A40;
		}
	</style>
</head>
<body>
		<!-- Banner -->
		<div style="background-color: black;color: white; text-align: center; height: 50px; width: auto;padding-top: 10px; ">
			<b style=" font-family: monospace; font-size: 19px;">FREE GROUND SHIPPING ON ALL VN ORDERS $100+</b>
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
					        <div class="dropdown-menu" style="width: 20px;">
					          	<a href="logout.php" class="btn btn-outline-dark">Sign-out</a>
					        </div>
					     </li>
					</ul>
				<?php
					}
				?>			
			</div>
		</div>
		<br>
		<div style="height: 100px; padding-top:40px;border-bottom: 1px solid black;border-top: 1px solid black">
			<h2 style="font-family:monospace; text-align: center;font-size: 25px">Checkout</h2>
		</div>
		<br>

<div class="row">
  <div class="col-75">
    <div class="container">
 
      <form method="POST">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <br>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="receiver" placeholder="Input receiver..."  value ="<?php echo $receiver; ?>" required>

 			<label for="adr"><i class="fa fa-map-marker-alt"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Address..." value ="<?php echo $address; ?>"required>

            <label for="phone"><<i class="fa fa-phone"></i>></i>Phone number</label>
            <input type="text" id="phone" name="phone" placeholder="Input phone number..." value ="<?php echo $phone; ?>"required>

 
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label>Only COD</label>
          </div>
          
        </div>
        
        <button type="submit" class="btn" name="btn_Checkout">Confirm Payment</button>
      </form>
    </div>
  </div>
</div>
		<br><br><br>
		<!-- FOOTER -->
		<footer class="text-white text-center text-lg-start bg-dark">
		    <!-- Grid container -->
		    <div class="container p-4" style="background-color:#343A40; ">
		      <!--Grid row-->
		      <div class="row mt-4">      

		        <!--Grid column-->
		        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
		          <h5 class="text-uppercase mb-4 pb-1"  style="padding-left: 1em;" >Contact us</h5>

		          <hr>


		          <ul class="fa-ul">
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
		          <h5 class="text-uppercase mb-4" style="padding-left: 4em;"> Opening hours</h5>

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
		      © 2020 Copyright: BKC-Antiques
		    </div>
		    <!-- Copyright -->
		</footer>
</body>
</html>
