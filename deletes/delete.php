<?php
 session_start();
 $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

 $id = $_GET['var'];
 $query = "DELETE FROM skills WHERE id = '$id'";
 $data=mysqli_query($conn,$query);
 
 if($data){
   echo '<script type= "text/javascript">';
   echo 'alert("Data Delete successful");';
   echo 'window.location.href = "delete.php"';
   echo  '</script>';
   header("location: ../Resume/skills.php");
 }else{
   header("location: ../Resume/skills.php");
   echo '<script type= "text/javascript">';
   echo 'alert("Data delete unsuccessful");';
   echo 'window.location.href = "skills.php"';
   echo  '</script>';
}
?>