<?php 
	// Luôn kiểm tra có đăng nhập hay ko 
	session_start();
	if(isset($_SESSION['admin']['id']) == false){
		header("Location:login.php");
		die();
	}

	// Lấy id sản phẩm cần xoá
	$id_brand = $_GET['id'];
	$sql = "DELETE FROM brand WHERE id = '$id_brand'";

	// Kết nối
	require_once("connect.php");

	// Thực thi xoá 
	$result = mysqli_query($conn,$sql);

	// Thành công -> hone-product
	if($result == false){
		die("Lỗi: ".mysqli_error($conn));
	}
	else{
		header("Location:home_brand.php");
		die();
	}

 ?>