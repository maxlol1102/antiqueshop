<?php 
	// Luôn kiểm tra có đăng nhập hay ko 
	session_start();
	if(isset($_SESSION['admin']['id']) == false){
		header("Location:login.php");
		die();
	}

	// Lấy id sản phẩm cần xoá
	$id_types = $_GET['id'];
	$sql = "DELETE FROM types WHERE id = '$id_types'";

	// Kết nối
	require_once("connect.php");

	// Thực thi xoá 
	$result = mysqli_query($conn,$sql);

	// Thành công -> hone-product
	if($result == false){
		die("Lỗi: ".mysqli_error($conn));
	}
	else{
		header("Location:home_types.php");
		die();
	}

 ?>