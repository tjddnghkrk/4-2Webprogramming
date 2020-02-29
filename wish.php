<?php
session_start();//세션 선언

if(!isset($_SESSION['login'])){//비 로그인사용자 방지
	header("Location:main.php?error=1");
}
$id = $_SESSION['login'];
$sellname = $_GET['id'];
$product_num = $_GET['product'];
$pr_subject = $_GET['subject'];
$pr_category = $_GET['category'];
$pr_deal = $_GET['deal'];
if($_GET['soldout'] == NULL)
$soldout = 0;
if($_GET['soldout'] == 1)
$soldout = 1;

$con = mysqli_connect('localhost','flea','7941','flea');//DB연결
$query = "INSERT INTO wishlist ( id, product_num, product_subject, product_category, product_deal, sell_name, soldout) VALUES ('$id', '$product_num', '$pr_subject', '$pr_category', '$pr_deal', '$sellname', '$soldout')";
mysqli_query($con,$query);
mysqli_close($con);
echo "<script>alert('위시 리스트에 넣었습니다!')</script>"."<script>history.back()</script>";
?>
