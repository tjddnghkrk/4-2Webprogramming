<?php
session_start();//세션 선언

if(!isset($_SESSION['login'])){//비 로그인사용자 방지
	header("Location:main.php?error=1");
}
$con = mysqli_connect('localhost','flea','7941','flea');//DB연결


$mtotal=0;//총 게시물 수
$mview=9;//한 페이지당 보여줄 게시물 수
$mlink;//전체 페이지 수 ceil(($mtotal/$mview)+0.5);
$mpage;//현재 머물고 있는 페이지


/*현재 페이지*/
if(isset($_GET['mpage']) && $_GET['mpage'] !=""){
		$mpage = $_GET['mpage'];
}else{
	$mpage=1;
}

/*총 게시물 수 계산*/
$query = "SELECT * FROM wishlist WHERE id='$_SESSION[login]'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result)){
	$mtotal++;
}
/*전체 페이지 수 계산*/
$mlink=ceil(($mtotal/$mview)+0.5);

/*next 클릭시*/
if(isset($_GET['mnext']) && $_GET['mnext'] !="" ){
	$mpage=$_GET['mnext'];
}

/*pre 클릭시*/
if(isset($_GET['mpre']) && $_GET['mpre'] !="" ){

	if($_GET['mpre'] <= 0){
	$_GET['mpre']=1;
	}
	$mpage=$_GET['mpre'];
}

/*페이지 함수 호출*/
$pagarray = get_page($mtotal,$mview,$mlink,$mpage);

function get_page($mtotal,$mview,$mlink,$mpage) {//함수정의
  $p[total] = ceil($mtotal / $mview);
  $p[srt] = floor(($mpage -1) / $mlink) * $mlink +1;
  $p[end] = ($p[srt] + $mlink -1 > $p[total]) ? $p[total] : $p[srt] + $mlink -1;
  $p[prev] = ($mpage < $mlink) ? $p[srt] : $p[srt] -1;
  $p[next] = ($p[end] +1 > $p[total]) ? $p[end] : $p[end] +1;
  return $p;
}

?>
<html>
<style>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
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
	height:100px;
	font-size:30;
}
td.key{
	background:lightgray;
	text-align:center;
}
td.value{
	background:white;
	text-align:center;
}
td.value2{
	background:white;

}
td.info{
	background:white;
	height:50px;
	font-size:25;
}
a.written{
	color:black;
	text-decoration:none;
}a.written:hover{
	color:lightskyblue;
}
a.button{
	font-size:15px;
	color:gray;
	text-decoration:none;
}a.button:hover{
	color:white;
	background:black
}
a.ipage{
	font-size:30;
	color:darkgray;
	text-decoration:none;
}a.ipage:hover{
	color:gray;
}
a.wpage{
	font-size:30;
	color:#0054FF;
	text-decoration:none;
}a.wpage:hover{
	color:gray;
}
a.item{
	font-size:15px;
	color:black;
	text-decoration:none;
}a.item:hover{
	color:white;
	background:black
}
</style>
<body>
<table border=0 width=100%>
<tr>
<td class="top0" colspan=5 > WISH LIST </td>
</tr>
<tr>
</tr>

<tr>
<td class="key"><b>ID</b></td>
<td class="key"><b>TITLE</b></td>
<td class="key"><b>CATEGORY</b></td>
<td class="key"><b>DEAL</b></td>
<td class="key"><b>STATE</b></td>
</tr>
<?php
$query = "SELECT * FROM wishlist WHERE id='$_SESSION[login]' ORDER BY outoID DESC";
$result = mysqli_query($con,$query);
$item=0;
while($row = mysqli_fetch_array($result)){
	if($item >= (($mpage*9)-9)){
?>

<tr>
<td class="value" width=15%><?php echo "<a class=written href=board.php?outoid=$row[product_num]>".$row[sell_name]."</a>";?></td>
<td class="value2" width=40%><?php echo "<a class=written href=board.php?outoid=$row[product_num]>".$row[product_subject]."</a>";?></td>
<td class="value" width=20%><?php echo "<a class=written href=board.php?outoid=$row[product_num]>".$row[product_category]."</a>";?></td>
<td class="value" width=15%><?php echo "<a class=written href=board.php?outoid=$row[product_num]>".$row[product_deal]."</a>";?></td>
<td class="value" width=10%><?php if($row[soldout]==1){echo "<font color=red>판매완료</font>";}else{echo "<font color=blue>판매중</font>";}?></td>
</tr>
<?php
	}
	$item++;
	if($item == $mpage*9){//전부 게시물을 출력했을경우 반복문 빠져나감
		break;
	}

}//반복문 끝
?>
</table>
</body>
</html>

<?php //페이지 이동

echo "</from>";

echo "<hr/><center>";
echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
echo "<a class='item' href=mywritten.php?mpagearray=$pagarray[prev]> [◀]　</a>";
for($i=$pagarray[srt]; $i<=$pagarray[end]; $i++) {

	if($page==$i){
			echo "<a class='item' href=mywritten.php?mpage=$i><b> [ ".$i." ] </b></a>";
	}else{
		echo "<a class='item' href=mywritten.php?mpage=$i&sort=$sort> [ ".$i." ] </a>";
	}

}
echo "<a class='item' href=mywritten.php?mpage=$i&mpagearray=$pagarray[next]>　[▶] </a>";
echo "</form>";
echo "<br/><hr/>";
echo "</center>";
mysqli_close($con);//DB연결 해제


echo "<a class=button href='main.php?category=$category&page=$page'>[HOME]</a>　";

?>
