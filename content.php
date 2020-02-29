<?php session_start();//세션 선언

if(isset($_GET[registration])&&$_GET[registration]==1){//첫 등록후 방문자일때
	$_GET[registration]=="null";
	echo "<script> alert('가입을 환영합니다.')</script>";

}

?>

<!DOCTYPE html>
<html>
<head>
    <title> Content Page </title>
	<link href="content.css" type="text/css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Dosis:800|Signika:700|Ubuntu:700&display=swap" rel="stylesheet">
<style>
body{font-family:arial;}
table{font-size:100%;background:lightgray;}
a.top{color:black;text-decoration:none;text-align:center;font:bold;font-family: 'Dosis', sans-serif;}
a.top:hover{color:darkgray;}

a.intable{color:white;text-decoration:none;text-align:center;font:bold;font-family: 'Ubuntu', sans-serif;}
a.intable:hover{color:rgb(175,230,230)}

td.menu0{
	width:20%;
	text-align:center;
	align:center;
}

td.menu{
	height: 30px;
	font-size:110%;
	margin:30px 30px;
	text-align:center;
}
table.menu{
	width:auto%;
	font-size:100%;
	color:black;
	position:absolute;
	visibility:hidden;
}
</style>
<script type="text/javascript">
/*메뉴 이벤트*/
function showmenu(elmnt)
{
document.getElementById(elmnt).style.visibility="visible";
}
function hidemenu(elmnt)
{
document.getElementById(elmnt).style.visibility="hidden";
}

/*검색어 추천이벤트*/
function showHint(str)
{
if (str.length==0)
  {
  document.getElementById("txtHint").innerHTML="";
  document.getElementById("txtHint").style.border="0px solid red";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	document.getElementById("txtHint").style.border="1px solid black";
    }
  }
xmlhttp.open("GET","gethint.php?q="+str,true);
xmlhttp.send();
}
</script>


</head>
<body>


<div id="header0">
<h1>
<?php
if(!isset($_SESSION['login'])){//비 로그인사용자 방지
	echo "- - >　　";
	echo "<a class=top href=registration.php>SIGN UP　　</a>";
	echo "<a class=top href=login.php>LOG IN　　</a>";
}else{
	echo "Hi　".$_SESSION['login']."　　";
	echo "<a class=top href=logout.php>LOG OUT　　</a>";
}
?>

<a class="top" href="mypage.php" target="iframe">MY PAGE　　</a>
<a class="top" href="mboxfrom.php" target="iframe">MESSAGES　　</a>
<a class="top" href="wishlist.php" target="iframe">WISH LIST　　</a>
</h1>

</div>
<br><br><br>
<div id="header1">

<a class= "title" style="text-align:center;" href="content.php" ><img src="img/skkumarket2.png" style="width:800px;height:160px;"></a>
</div>
<br>
<div id="header2">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table>
<tr>
<td><input type="text" name="search" size="35" onkeyup="showHint(this.value)" style="font-size:13pt; height:30px; width:300px"></td>
<td><input type="image" value="검색" src="img/search.jpg" width="34" height="34" align="center">
</td>
</tr>
</table>
<div style="width:300px" id="txtHint" ></div>

</form>

</div>

<?php
/*검색 기능구현부*/
if(isset($_POST['search'])){
	 $_SESSION['search'] = $search = searchtrim($_POST['search']);
}else if(isset($_GET['search'])){
	$_SESSION['search'] = $search = searchtrim($_GET['search']);
}

function searchtrim($arg){
	$arg = htmlspecialchars($arg);
	$arg = trim($arg);
	return $arg;
}
?>

<div class="menu">
<hr/>
<table width="100%" cellpadding="15">
 <tr style="background-color: rgb(90,185,155)">
  <td class="menu0" onmouseover="showmenu('1')" onmouseout="hidemenu('1')">
   <a class="intable" href="main.php?category=0" target="iframe" ><font size="4">ALL</font></a><br />
  </td>

  <td class="menu0" onmouseover="showmenu('2')" onmouseout="hidemenu('2')">
   <a class="intable" href="main.php?category=12" target="iframe"><font size="4">FASION / BEAUTY</font></a><br />
   <table class="menu" id="2" width="200">
   <tr><td class="menu"><a class="intable" href="main.php?category=1" target="iframe">FASION</a></td></tr>
   <tr><td class="menu"><a class="intable" href="main.php?category=2" target="iframe">BEAUTY</a></td></tr>
   </table>
  </td>

  <td class="menu0" onmouseover="showmenu('3')" onmouseout="hidemenu('3')">
   <a class="intable" href="main.php?&category=34" target="iframe"><font size="4">DIGITAL</font></a><br />
   <table class="menu" id="3" width="200">
   <tr><td class="menu"><a class="intable" href="main.php?category=3" target="iframe">COMPUTER</a></td></tr>
   <tr><td class="menu"><a class="intable" href="main.php?category=4" target="iframe">CAMERA</a></td></tr>
   </table>
  </td>

  <td class="menu0" onmouseover="showmenu('4')" onmouseout="hidemenu('4')">
   <a class="intable" href="main.php?category=56" target="iframe"><font size="4">LIFE</font></a><br />
   <table class="menu" id="4" width="200" >
   <tr><td class="menu"><a class="intable" href="main.php?category=5" target="iframe">KITCHEN / BATHROOM</a></td></tr>
   <tr><td class="menu"><a class="intable" href="main.php?category=6" target="iframe">FURNITURE</a></td></tr>
   </table>
  </td>

  <td class="menu0" onmouseover="showmenu('5')" onmouseout="hidemenu('5')">
   <a class="intable" href="main.php?category=7" target="iframe"><font size="4">ECTS</font></a><br />
  </td>
 </tr>
</table>
<hr/>
</div>


<div id="content_main" align="center" style="float:left;">
<iframe src="main.php" width="70%" height="800" name="iframe" scrolling="auto" style=  display:block; auto; border:1px solid></iframe>
</div>


</body>
</html>
