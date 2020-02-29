<!DOCTYPE html>
<?php
session_start();



if (isset($_POST['submit'])) {
	if($_POST['id']=="#admin"){
		header("Location:adminlogin.php");
	}
    $id = input($_POST['id']);//유효성 검사 후 이름 변수 할당
    $pass = input($_POST['pass']);//유효성 검사 후 패스워드 변수 할당

	LoginCheck($id,$pass);//로그인 가능 여부 체크 함수 호출
}
?>

<?php
/*로그인 가능여부 체크 함수*/
function LoginCheck($id,$pass){
	$con = mysqli_connect('localhost','flea','7941','flea');//DB연결
	$query = "SELECT id, pass FROM users WHERE id='$id' AND pass='$pass'";//이름,패스워드 쿼리문
    $result = mysqli_query($con,$query);//이름,패스워드 쿼리결과 할당

	if ( mysqli_num_rows($result) > 0 ) {//정상적인 이름,패스워드 접근
            $_SESSION['login']=$id;//세션에 사용자 이름 할당
            header("Location: content.php");
    }else if (empty($_POST['id']) || empty($_POST['pass'])) {//ID or패스워드가 비었을 때
		if(empty($_POST['id']) && !empty($_POST['pass'])){
			echo "<script> alert('ID를 입력하세요.')</script>";
		}else if(!empty($_POST['id']) && empty($_POST['pass'])){
			echo "<script> alert('P·W를 입력하세요.')</script>";
		}else{
			echo "<script> alert('ID와 P·W를 입력하세요.')</script>";
		}

    }else{//ID or패스워드가 잘못되었을 때
		echo "<script> alert('ID또는 P·W를 다시 한 번 확인해주세요.')</script>";
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
    <title> Login Page </title>
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


	<div style=" color:black; WIDTH: 100%; HEIGHT: 100%">

	<div class="header">
	<a class="flea" href="content.php"><img src="img/skkumarket2.png" style="width:240px;height:50px;"></a>
	</div>
	<div style="background-color:white; margin-top : 7em; margin-left: auto; margin-right: auto; padding : 2em; width:400px; border-radius:10px;border:2px solid darkgray;	">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <table border="0" style="margin-left:1em;">

        <tr>
					<br><br>
            <td colspan="1" width="40" height="40" align="center"> <b>I D</b> </td>
            <td colspan="2" width="300" height="40"> <input type="text" name="id" style="font-size:13pt; height:25px; width:300px"> </td>
        </tr>
        <tr>
            <td colspan="1" width="40" height="60"align="center"> <b>P·W</b> </td>
            <td colspan="2" width="300" height="60"> <input type="password" name="pass" style="font-size:13pt; height:25px; width:300px"> </td>
        </tr>
		<tr>
		<td colspan="3"  width="300" height="80"align="center">
            <input type="submit" name="submit" value=" Login "  style="font-size:15pt;"> </td>
		</tr>
        <tr>
            <td colspan="3" width="200" height="60" align="center"><b><a class=loginservice href="registration.php"> Sign up</a>　|　
			<a class=loginservice href="find.php"> ID / Password Find &nbsp</a> |
		<a class=loginservice href="adminlogin.php"> &nbsp Admin</a></b></td>

        </tr>
        </table>

    </form>

	</div>

</div>

</body>
</html>
