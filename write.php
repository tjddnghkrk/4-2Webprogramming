<!DOCTYPE html>

<?php session_start();//세션 선언
if(!isset($_SESSION['login'])){//비 로그인사용자 방지
   header("Location:main.php?error=1");
}
?>
<style>
div.giude{
    font-weight:bold;
}
</style>

<?php
/*글작성 버튼 클릭시*/
if(isset($_POST['submit'])){
   /*필수항목 존재*/
   if(isset($_POST['subject']) && isset($_POST['content']) && $_POST['subject']!="" && $_POST['content']!="" &&
      isset($_POST['category']) && $_POST['category'] !="" && $_POST['price']!="" && $_POST['price']!=""&&
      isset($_POST['deal']) && $_POST['deal']!=""){
         $con = mysqli_connect('localhost','flea','7941','flea');//DB연결

      $subject = nohtml($_POST['subject']);
      $id = $_SESSION['login'];
      $category = $_POST['category'];
      $deal = $_POST['deal'];
      $price = $_POST['price'];
      $file = $_FILES['image']['tmp_name'];

      if(isset($file)){
         $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
         $image_name = addslashes($_FILES['image']['name']);
         $image_size = getimagesize($_FILES['image']['tmp_name']);
         if($image_size == FALSE) {
            $image_name = null;
            $image_data = null;
         }
      }

         $content = $_POST['content'];
         $query = "INSERT INTO writes (id, subject,category,deal,price,content,imgname,data) VALUES ('$id','$subject','$category','$deal','$price','$content','$image_name','$image_data')";
         mysqli_query($con,$query);
         mysqli_close($con);
         header("Location:main.php");


      //DB연결 해제

   }else{/*제목과 내용이 존재하지 않을 때*/
      echo "<script> alert('입력 항목을 확인하세요.')</script>";
   }
}else if(isset($_POST['cencel'])){
   /*취소 버튼 입력시*/
   header("Location:main.php");
}

function nohtml($arg){
   $arg = htmlspecialchars($arg);
   return $arg;
}
?>

<?php

?>

<html>
<body>

<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

<div class="giude"><b>SUBJECT</b></div><br>
<div><input type="text" name="subject" size="25" style="font-size:13pt; width:50%; height:25px"></div><br/>
<div class="giude">CATEGORY
<select name="category" ailgn=center>
   <option value="">- 카테고리 선택 -</option>
   <option value="의류">의류</option>
   <option value="뷰티">뷰티</option>
   <option value="컴퓨터/주변기기">컴퓨터/주변기기</option>
   <option value="카메라">카메라</option>
   <option value="주방/욕실">주방/욕실</option>
   <option value="가구">가구</option>
   <option value="기타">기타</option>
</select>　/　DEAL
<select name="deal">
   <option value="">- 거래방식 선택 -</option>
   <option value="안전거래">안전거래</option>
   <option value="택배거래">택배거래</option>
   <option value="직거래">직거래</option>
   <option value="기타">기 타</option>
</select>
</div>
<br>
<div class="giude">PRICE
<input type="text" name="price" size="10"> 원</div>
<br>
<div><textarea rows="20%" cols="110%" name="content"></textarea></div>
<br>
<div class="giude">IMAGE UPLOADE</div>
<div><input type="file" name="image" style="font-size:11pt; color:white;background-color:lightgray;">
</div>

<div>
<center>

<input type="submit" name="submit" value="WRITE" style="font-size:15pt; border-radius: 5px; color:white;background-color:rgb(75,174,138);">
<input type="submit" name="cencel" value="CANCEL" style="font-size:15pt; border-radius: 5px;color:white;background-color:lightgray;">
</center>
</div>

</form>

</body>
<html>
