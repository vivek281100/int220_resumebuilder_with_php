<?php
 session_start();
 $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

 $id = $_GET['var'];
 $query = "DELETE FROM imageup WHERE id = '$id'";
 $data=mysqli_query($conn,$query);
 
 if($data){
   echo '<script type= "text/javascript">';
   echo 'alert("Data Delete successful");';
   echo 'window.location.href = "deleteimg.php"';
   echo  '</script>';
   header("location: ../imageup.php");
 }else{
   echo '<script type= "text/javascript">';
   echo 'alert("Data delete unsuccessful");';
   echo 'window.location.href = "deleteimg.php"';
   echo  '</script>';
   header("location: ../imageup.php");
}
?>