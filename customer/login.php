<?php
// Xử lí đăng nhập tại đây

if(isset($_POST['btnLogin'])){
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    $pwd = md5($pwd);
    // Kết nôi DB và thực thi sql
    require_once('connect.php');
    // CHuẩn bị câu lệnh
    $sql = "SELECT id,name FROM customer WHERE (email ='$user' OR phone_no='$user') AND password='$pwd'";
    // Thực thi
    $result = mysqli_query($conn,$sql);
    if($result == false){
        die("Lỗi: ".mysqli_error($conn));
    }
    else{
        // Câu đúng về cú phap -> Cần xem có bao nhiêu bản ghi
        if(mysqli_num_rows($result) > 0){
            // Lưu lại session 
            session_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION['customer']['id'] = $row['id'];
            $_SESSION['customer']['name'] = $row['name'];
            // Chuyển hướng về home
            header("Location:home.php");
            die(); 
        }
        else{
            $info = 'Incorrect Email or Password!';
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;

		}

		body{
	
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

			height: 555px;
			width: 100%;
			background-color:lightgrey;
		}

		.form-control {
		    display: block;
		    width: 100%;
		    height: calc(1.5em + 1rem + 2px);
		    padding: .5rem 1rem;
		    font-size: 1rem;
		    font-weight: 400;
		    line-height: 1.5;
		    color: #404040;
		    background-color: #fff;
		    background-clip: padding-box;
		    border: 1px solid #e1e1e1;
		    border-radius: 0;
		    -webkit-transition: border-color 0.2s ease-in-out,-webkit-box-shadow 0.2s ease-in-out;
		    transition: border-color 0.2s ease-in-out,-webkit-box-shadow 0.2s ease-in-out;
		    transition: border-color 0.2s ease-in-out,box-shadow 0.2s ease-in-out;
		    transition: border-color 0.2s ease-in-out,box-shadow 0.2s ease-in-out,-webkit-box-shadow 0.2s ease-in-out;
		}
		.input-group>.form-control, .input-group>.form-control-plaintext, .input-group>.custom-select, .input-group>.custom-file {
		    position: relative;
		    -webkit-box-flex: 1;
		    -ms-flex: 1 1 auto;
		    flex: 1 1 auto;
		    width: 1%;
		    margin-bottom: 0;
		}
		.input-group-text {
		    display: -webkit-box;
		    display: -ms-flexbox;
		    display: flex;
		    -webkit-box-align: center;
		    -ms-flex-align: center;
		    align-items: center;
		    padding: .5rem 1rem;
		    margin-bottom: 0;
		    font-size: 1rem;
		    font-weight: 400;
		    line-height: 1.5;
		    color: #404040;
		    text-align: center;
		    white-space: nowrap;
		    background-color: #fff;
		    border: 1px solid #e1e1e1;
		}
		#btnlogin{
			background-color: grey; 
			color: white
		}
		#btnlogin:hover{
			background-color:lightgrey; 
			color: black;
		}
		#btnre:hover{ 
			color:white;
		}
	</style>
</head>
<body>
	<div id="header">
		<div id="logo">
			<a href="home.php">
				<img src="https://scontent.xx.fbcdn.net/v/t1.15752-0/s480x480/194580260_488809879032826_2341979794773693032_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=58c789&_nc_ohc=sXJRhaIlN-EAX9zithk&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&tp=7&oh=545c90a9b95aa26fa7b973a5dd7cc2b1&oe=60DEE483" style="height: 9vh;width: 180px;
			align-items: center; ">
			</a>
		</div>		
			
		
			<!-- ICON -->
			<div style="float:right">
				<!-- CART -->
				<div class="icon_header">
						<a href="cart.php">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-cart-plus" viewBox="0 0 16 16">
								<path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
								<path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>	
						</a>
				</div>
				<!-- dang nhap -->
				<div class="icon_header">
						<a href="login.php">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-person" viewBox="0 0 16 16">
								<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
								</svg>
						</a>
				</div>	
				<div class="icon_header">
						<a href="home.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-house" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
							  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
							</svg>
						</a>
				</div>	
			</div>
	</div>
	

	<!-- CONTENT -->
	<div id ="content">
		<div class="container pb-5 mb-sm-4">
		    <div class="row pt-5">
		        <div class="col-md-6 pt-sm-3">
		            <div class="card">
		                <div class="card-body">
		                    <h2 class="h4 mb-1">Sign in</h2>
		                    <h2 style="color:red; font-size:12px;">
								<?php 
									if(isset($info)) echo $info;
								?>
							</h2>
		                    <hr>
		                    <form class="needs-validation" novalidate="" method="POST">
		                        <div class="input-group form-group">
		                            <div class="input-group-prepend"><span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span></div>
		                            <input class="form-control" type="email" placeholder="Email or Phone number" name ='user' required>
		                            <div class="invalid-feedback">Please enter valid email address or phone number!</div>
		                        </div>
		                        <div class="input-group form-group">
		                            <div class="input-group-prepend"><span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></span></div>
		                            <input class="form-control" type="password" placeholder="Password" name='pwd' required>
		                            <div class="invalid-feedback">Please enter valid password!</div>
		                        </div>
		                        <div class="d-flex flex-wrap justify-content-between">
		                            <div class="custom-control custom-checkbox">
		                                <input class="custom-control-input" type="checkbox" checked="" id="remember_me">
		                                <label class="custom-control-label" for="remember_me">Remember me</label>
		                            </div>
		                        </div>
		                        <hr class="mt-4">
		                        <div class="text-right pt-4">
		                            <button id ="btnlogin"class="btn" type="submit" name="btnLogin">Sign In</button>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		  					
			<div class="col-md-6 pt-6 pt-sm-3" >
			    <h2 class="h4 mb-3">New Customer</h2>
			    <p class="text-muted mb-4">Registration takes less than a minute but gives you full control over your orders.</p>
			    <p class="text-muted mb-1">Create an account with us and you'll be able to:</p><br>
			    <p class="text-muted mb-2"> -Check out faster</p>
			    <p class="text-muted mb-2"> -Save multiple shipping addresses</p>
			    <p class="text-muted mb-2"> -Access your order history</p>
			    <p class="text-muted mb-2"> -Track new Orders</p>
			    <a style="color: white" href="register.php"><button id="btnre" style="background-color:grey;" class="btn"> Create Account</button></a>
		 	</div>
	
			</div>
		</div>
	</div>
 	

</html>