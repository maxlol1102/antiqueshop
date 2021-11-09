<?php 
session_start();
if(isset($_GET['id'])){
 
    if(isset($_GET['action']))  $action = $_GET['action'];


	if($action=='tangsl'){
		$_SESSION['cart'][$_GET['id']] ++ ;
	}

	if($action=='giamsl'){
		$_SESSION["cart"][$_GET['id']] -- ;
	}
}

header("Location:cart.php");

?>
									