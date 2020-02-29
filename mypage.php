<?php
session_start();//세션 선언

if(!isset($_SESSION['login'])){//비 로그인사용자 방지
	header("Location:main.php?error=1");
}
$con = mysqli_connect('localhost','flea','7941','flea');//DB연결

$category = $_GET['category'];
$page = $_GET['page'];

$query = "SELECT * FROM users WHERE id='$_SESSION[login]'";
$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){

?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Dosis:800|Signika:700|Ubuntu:700&display=swap" rel="stylesheet">

<style>
table{font-size:100%;background:lightgray;}
td.top0{

		font-family: 'Roboto';
		text-align: center;
		background:#353535;
		height:40px;
		font-size:20;
		color:white;
}
td.top1{
	background:white;
	height:60px;
	font-size:30;
}
td.key{
	background:#EAEAEA;
	width:10%;
	height:50px;
	text-align:center;
}
td.value{
	background:white;
}
td.info{
	background:white;
	height:40px;
	font-size:15;
}
a.button{
	font-size:15px;
	color:gray;
	text-decoration:none;
}a.button:hover{
	color:white;
	background:black;
}
a.ipage{
font-family: 'Roboto';
	font-size:20;
	color:#0054FF;
	text-decoration:none;
}a.ipage:hover{
	color:blue;
}
a.wpage{
	font-size:20;
	color:darkgray;
	text-decoration:none;
}a.wpage:hover{
	color:black;
}
</style>
</head>
<body>
<table border=0 width=100%>
<tr>
<td class="top0" colspan=2 >MY PAGE</td>
</tr>
<tr>
<td class="top1" colspan=2 >
<a class=ipage href=mypage.php>　INFOMATION</a>　|
<a class=wpage href=mywritten.php>　MY WRITING</a>

</td>
</tr>

<tr>
<td class=info colspan=2 ><b>　REQUIRED</b></td>
</tr>
<tr>
<td class="key">I D</td>
<td class="value"><?php echo $row[id];?></td>
</tr>
<tr>
<td class="key">Name</td>
<td class="value"><?php echo $row[name];?></td>
</tr>
<td class="key">E-mail</td>
<td class="value"><?php echo $row[email];?></td>
</tr>


<tr>
<td class=info colspan=2><b>　OPTIONAL</b></td>
</tr>
<tr>
<td class="key">Gender</td>
<td class="value"><?php echo $row['gender'];?></td>
</tr>
<tr>
<td class="key">P·H</td>
<td class="value"><?php echo $row[hp];?></td>
</tr>
<tr>
<td class="key">Adress</td>
<td class="value"><?php echo $row[adress];?></td>
</tr>
</table>
<br>
</body>
</html>

<?php

}//반복문 끝





mysqli_close($con);//DB연결 해제

echo "<a class=button href='main.php?category=$category&page=$page'>[홈]</a>　";
echo "<a class=button href='mypageupdate.php?outoid=$outoid&category=$category&page=$page&id=$id'>[개인정보수정]</a>";

?>
