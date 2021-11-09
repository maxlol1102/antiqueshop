<?php
/*Xoa phien lam viec o session*/
session_start();
if(isset($_SESSION['admins'])) unset ($_SESSION['admins']);
/*chuyen huong ve login*/
header("Location:login.php");
die();
?>