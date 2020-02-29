<!DOCTYPE html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Jua&display=swap" rel="stylesheet">

<style>
a{
	font-size:23px;
	color:white;
	background:gray;
	border-radius: 5px;
	text-decoration:none;
}a:hover{
	color:white;
	background:rgb(75,174,138);
}
a.messages{
	font-size:18px;
	color:white;
	text-decoration:none;
	background:rgb(75,174,138);
	border-radius: 5px;
}a.messages:hover{
	background:rgb(55,154,118);
}
</style>
</head>
<?php session_start();//세션 선언

if(!isset($_SESSION['login'])){//비 로그인사용자 방지
	header("Location:main.php?category=$_GET[category]&page=$_GET[page]&error=1");
}

if(isset($_GET['error'])&&$_GET['error']==1){//피권한자 삭제방지문구
	$_GET[error]="null";
	echo "<script> alert('권한이 없습니다.')</script>";
}

$con = mysqli_connect('localhost','flea','7941','flea');//DB연결

$outoid = $_GET['outoid'];
$category = $_GET['category'];
$page = $_GET['page'];

/*판매 상태변경시*/
if(isset($_POST['soldout'])){
	$outoid = $_POST['outoid'];
	$category = $_POST['category'];
	$page = $_POST['page'];
	$query = "UPDATE writes SET soldout=1 WHERE outoID='$outoid'";
	$result = mysqli_query($con,$query);
	echo "<script> alert('Changed \'Sold Out\'')</script>";
}else if(isset($_POST['sale'])){
	$outoid = $_POST['outoid'];
	$category = $_POST['category'];
	$page = $_POST['page'];
	$query = "UPDATE writes SET soldout=0 WHERE outoID='$outoid'";
	$result = mysqli_query($con,$query);
	echo "<script> alert('Changed \'Sale\'')</script>";
}

$query = "SELECT * FROM writes WHERE outoID='$outoid'";
$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
	if($_SESSION['login']==$row['id']){
		if($row['soldout']==0){
			echo "<form method=post action=".$_SERVER['PHP_SELF'].">
			<input type=hidden name=outoid value=$outoid>
			<input type=hidden name=category value=$category>
			<input type=hidden name=page value=$page>
			<font color='#6799FF' size='4'><b>[ Sale ]</b></font>　/　상태 변경 <input type=submit name=soldout value=SoldOut>
			</form>";
		}if($row['soldout']==1){
			echo "<form method=post action=".$_SERVER['PHP_SELF'].">
			<input type=hidden name=outoid value=$outoid>
			<input type=hidden name=category value=$category>
			<input type=hidden name=page value=$page>
			<font color='red' size='4'><b>[ Sold Out ]</b></font>　/　상태 변경 <input type=submit name=sale value=Sale>
			</form>";
		}
		echo "<hr/>";
	}
	$id = $row['id'];

	echo "<font size='2'  color='gray'>[".$row['category']."] </font>";
	echo "<div><font size='3'>[".$row['deal']."] </font><font size='5'><b>". $row['subject'] ."</b></font></div>";
	echo "<div>";
	echo "<font size='7' color='navy'><b>". $row['price'] ."원</b> </font></div><br/>";
	echo "<div><b>작성자</b><font size='2' color='deepskyblue'> : ". $row['id'] ."</font>";
	echo "　<a class=messages href=msend.php?mto=".$row['id'].">　SEND MESSAGE　</a>"." ";
	echo "<a class=messages href='wish.php?product=".$row['outoID']."&id=".$row['id']."&category=".$row['category']."&deal=".$row['deal']."&subject=".$row['subject']."&soldout=".$row['soldout']."'>　ADD TO WISH LIST　</a></div>";

	echo "<hr/>";
	echo "<div style='background-color:#F6F6F6;'>". $row['content'] ."</div>";
	if($row['data'] != null){
	echo "<div style='background-color:#F6F6F6;'><img src='data:$row/jpeg;base64," . base64_encode($row['data']) . "' width=700 height=auto></div>";
	}
}






mysqli_close($con);//DB연결 해제

echo "<br><hr/><br><a href='main.php?category=$category&page=$page'>　GO TO LIST　</a> ";
echo "<a href='update.php?outoid=$outoid&category=$category&page=$page&id=$id'>　EDIT　</a> ";
echo "<a href='delete.php?outoid=$outoid&category=$category&page=$page&id=$id'>　DELETE　</a><br><br> ";

?>
