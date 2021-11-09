<?php 
	// Xử lý thêm ảnh sản phẩm tại đây
	if(isset($_POST['btnRe'])){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['$pwd'];
		$password = md5($password);
    	require_once("connect.php");

		$sql = "INSERT INTO customer VALUES(NULL,'$name','$address','$phone','$email','$password')";


		// Thực thi -> thành công -> chuyển về list-product
		$result = mysqli_query($conn,$sql);
		if($result == false){
			die("Lỗi: ".mysqli_error($conn));
		}
		else{
			// Sign up thành công
			header("Location:login.php");
			die();
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style type="text/css">
		* {
		  --input-padding-x: 1.5rem;
		  --input-padding-y: .75rem;
		}

		body {
		  background: #007bff;
		  background: linear-gradient(to right, #0062E6, #33AEFF);
		}

		.card-signin {
		  border: 0;
		  border-radius: 1rem;
		  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
		  overflow: hidden;
		}

		.card-signin .card-title {
		  margin-bottom: 2rem;
		  font-weight: 300;
		  font-size: 1.5rem;
		}

		.card-signin .card-img-left {
		  width: 45%;
		  /* Link to your background image using in the property below! */
		  background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
		  background-size: cover;
		}

		.card-signin .card-body {
		  padding: 2rem;
		}

		.form-signin {
		  width: 100%;
		}

		.form-signin .btn {
		  font-size: 80%;
		  border-radius: 5rem;
		  letter-spacing: .1rem;
		  font-weight: bold;
		  padding: 1rem;
		  transition: all 0.2s;
		}

		.form-label-group {
		  position: relative;
		  margin-bottom: 1rem;
		}

		.form-label-group input {
		  height: auto;
		  border-radius: 2rem;
		}

		.form-label-group>input,
		.form-label-group>label {
		  padding: var(--input-padding-y) var(--input-padding-x);
		}

		.form-label-group>label {
		  position: absolute;
		  top: 0;
		  left: 0;
		  display: block;
		  width: 100%;
		  margin-bottom: 0;
		  /* Override default `<label>` margin */
		  line-height: 1.5;
		  color: #495057;
		  border: 1px solid transparent;
		  border-radius: .25rem;
		  transition: all .1s ease-in-out;
		}

		.form-label-group input::-webkit-input-placeholder {
		  color: transparent;
		}

		.form-label-group input:-ms-input-placeholder {
		  color: transparent;
		}

		.form-label-group input::-ms-input-placeholder {
		  color: transparent;
		}

		.form-label-group input::-moz-placeholder {
		  color: transparent;
		}

		.form-label-group input::placeholder {
		  color: transparent;
		}

		.form-label-group input:not(:placeholder-shown) {
		  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
		  padding-bottom: calc(var(--input-padding-y) / 3);
		}

		.form-label-group input:not(:placeholder-shown)~label {
		  padding-top: calc(var(--input-padding-y) / 3);
		  padding-bottom: calc(var(--input-padding-y) / 3);
		  font-size: 12px;
		  color: #777;
		}

	</style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" placeholder="Username" name="name"required autofocus>
                <label for="inputUserame">Username</label>
              </div>

               <div class="form-label-group">
                <input type="email" id="inputAddress" class="form-control" placeholder="Email address" name="address" required>
                <label for="inputAddress">Your Address</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputPhone" class="form-control" placeholder="Phone number" name="phone"required>
                <label for="inputPhone">Phone number</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email"required>
                <label for="inputEmail">Email address</label>
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required>
                <label for="inputPassword">Password</label>
              </div>
           

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="btnRe">Register</button>
              <a class="d-block text-center mt-2 small" href="login.php">Sign In</a>
 
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>