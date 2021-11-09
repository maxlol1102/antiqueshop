<?php
/*Xoa phien lam viec o session*/
session_start();
if(isset($_SESSION['customer'])) unset ($_SESSION['customer']);
/*chuyen huong ve login*/
header("Location:home.php");
die();
?>