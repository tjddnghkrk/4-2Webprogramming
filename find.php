<!DOCTYPE html>
<?php
session_start();

?>

<?php
/*정보찾기 함수*/
function find($name,$email){
	$con = mysqli_connect('localhost','flea','7941','flea');//DB연결
	$query = "SELECT * FROM users WHERE name='$name' AND email='$email' ";//쿼리문
    $result = mysqli_query($con,$query);//쿼리결과 할당

	if(empty($_POST['name']) ||empty($_POST['email'])){//항목을 전부 채우지 않을 경우
		echo "<script> alert('Please enter your Name or Email')</script>";
	}else{
		if ( mysqli_num_rows($result) > 0 ) {//쿼리 결과 일치
			while($row = mysqli_fetch_array($result))
				{
					echo "찾으신 ID 와 P·W는<br/><hr/>";
					echo "<b>I D</b> : ".$row['id']."<br/><br/>";
					echo "<b>P·W</b> : ".$row['pass']."<br/><br/>";
					$row['name'];
					$row['email'];
					$row['gender'];
					$row['hp'];
					$row['adress'];
					echo "<a href='login.php'>[ login ] 화면으로 돌아가기</a>";
				}

		}else if (!mysqli_num_rows($result) > 0) {//동일 이용자가 존재하여 등록 불가능할때
			echo "<script> alert('Wrong Name or Email !')</script>";
		}
    }

	mysqli_close($con);

}

/*유효성 검사 함수*/
function input($arg){
	$arg = trim($arg);
	$arg = htmlspecialchars($arg);
	$arg = stripslashes($arg);
	return $arg;
}
?>

<html>
<head>
    <title>  ID / Password 찾기 </title>
		<style>

		input[type="submit"] {
		    font-size: 3em;
			color:white;
		    width: 190px;
			height: 40px;
			background-color:rgb(75,174,138);
			border-radius:5px;
		}
		input[type="submit"]:hover{

		background-color: rgb(55,154,118);

		}


		.item {
			float: left;
			width: 10em;
			text-align: right;
			padding-right: 1em;
			font-weight:bold;
		}

		div.header
		{
			background-color:white;
			color:green;
			WIDTH: 100%;
			HEIGHT: 50px;
			TEXT-ALIGN: left;
			border-bottom:1px solid black;


		}



		a.flea{color:green;text-decoration:none;font-size: 1em;font:bold;}
		a.flea:hover{color:#505050;}

		a.mainlink{color:gray;text-decoration:none;font-size: 0.8em;}
		a.mainlink:hover{color:#505050;}

		a.loginservice{color:gray;text-decoration:none;}
		a.loginservice:hover{color:#505050;}

		</style>

</head>
<body>

<div style="background-color:ghostwhite; color:black; WIDTH: 100%; HEIGHT: 100%">

	<div class="header">
	<img src="img/skkumarket2.png" style="width:240px;height:50px;"><a class="flea" href="content.php"></a>
	</div>
<div style="background-color:white; margin: 3em auto; width:600px; border-radius:10px;border:2px solid darkgray;">

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table border="0" width="600">
<tr>
<td colspan="3" align="center" height="200">
<p style="font-size:25px; color:rgb(75,174,138">
<b>  ID / Password 찾기 　</b></p>
<?php
if (isset($_POST['submit'])) {
	//유효성 검사 후 변수 할당
	$name = input($_POST['name']);
	$email = input($_POST['email']);

	find($name,$email);//정보찾기 함수 호출
}
?>

 </td>
</td>
</tr>


<tr>
	<td height="150">
	<div class="item"><b>Name　</b></div> <input type="text" name="name" style="font-size:13pt; height:25px; width:300px">
	<br/><br/>
	<div class="item"><b>Email　</b></div><input type="text" name="email" style="font-size:13pt; height:25px; width:300px">
	</td>
</tr>
<tr>
	<td align="center" height="50"><input type="submit" name="submit" value=" Find " style=font-size:15pt; background-color:gray; </td>
</tr>

</table>
</form>
	</div>
</div>


</body>
</html>
