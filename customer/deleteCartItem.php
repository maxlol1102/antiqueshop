<?php
// Ko có giao diện -> xoá sản phẩm đó trong Session -> quay về giỏ hàng

if(isset($_GET['id'])){
    $id = $_GET['id'];
    session_start();
    unset($_SESSION['cart'][$id]);
}
header("Location:cart.php");
die();

?>