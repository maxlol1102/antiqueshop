<?php
if(isset($_POST['btnLogin'])){
	$email = $_POST['email'];
	$pw = $_POST['pwd'];
	//ma hoa MD5
	$pw = md5($pw);
	//cbi SQL de chay
	$sql = "SELECT id,name FROM admins WHERE email='$email' AND password = '$pw'";

	//Connet
	require_once("connect.php");
	//Run
	$result = mysqli_query($conn,$sql);
		
	if($result == false){
		//cau lenh sai cu phap
		die("ERROR: ".mysqli_error($conn));
	}
	else{
		//cau lenh dung-> co 1 ban ghi -> login success
		if(mysqli_num_rows($result) == 1){
			session_start();
			$row = mysqli_fetch_assoc($result);
			$_SESSION['admins']['id'] = $row['id'];
			$_SESSION['admins']['name'] = $row['name'];
			//chuyen huong ve home
			header("Location:home.php");
			die();
		}
		else{
			$info = "Wrong Password or Email :)";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN Login</title>
   	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style type="text/css">
		/* Made with love by Mutiullah Samim*/

		@import url('https://fonts.googleapis.com/css?family=Numans');

		html,body{
			background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
			background-size: cover;
			background-repeat: no-repeat;
			height: 100%;
			font-family: 'Numans', sans-serif;
		}

		.container{
			height: 100%;
			align-content: center;
		}

		.card{
			height: 370px;
			margin-top: auto;
			margin-bottom: auto;
			width: 400px;
			background-color: rgba(0,0,0,0.5) !important;
		}

		.social_icon span{
			font-size: 60px;
			margin-left: 10px;
			color: #FFC312;
		}

		.social_icon span:hover{
			color: white;
			cursor: pointer;
		}

		.card-header h3{
			color: white;
		}
		.social_icon{
			position: absolute;
			right: 20px;
			top: -45px;
		}
		.input-group-prepend span{
			width: 50px;
			background-color: #FFC312;
			color: black;
			border:0 !important;
		}
		input:focus{
		outline: 0 0 0 0  !important;
		box-shadow: 0 0 0 0 !important;
		}
		.remember{
			color: white;
		}
		.remember input
		{
			width: 20px;
			height: 20px;
			margin-left: 15px;
			margin-right: 5px;
		}

		.login_btn{
			color: black;
			background-color: #FFC312;
			width: 100px;
		}

		.login_btn:hover{
			color: black;
			background-color: white;
		}

		.links{
			color: white;
		}

		.links a{
			margin-left: 4px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<h2 style="color: white; font-size: 16px;">
					<?php
						if(isset($info)) echo $info;
					?>
				</h2>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="POST">
				
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Enter Email" name="email" required>
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder=" Enter Password" name="pwd" required>
					</div>

					<div class="form-group">
						<button type="submit" class="btn float-right login_btn" name="btnLogin"> Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>