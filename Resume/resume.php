<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<nav>
        <a href="../home.php" ><button> HOME</button></a>
        <a href="Resume/resume.php" class='active'><button>RESUME</button></a>
        <a href="../logout.php"><button>LOGOUT</button></a>
    </nav>
<div class="fullresumeuser">
    <div class="resumeuser">
        <h1><?php echo ($_SESSION['Username'])?>, Let's start with your resume.</h1>
        <div class="resumeclass">
            <form  autocomplete='off' action="resume.php" method="GET">
        
                <div class="moto">
                    <table>
                        <thead><u><h3>About</h3></u></thead>
                        <tr rowspan='3'>
                            <th colspan='1'>Summary :</th>
                            <th colspan='3'><textarea name="summary"autocomplete="false" placeholder='Summary' class='tagline' cols="45" rows="4" required=''></textarea></th>
                        </tr>
                        <tr>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan='1'>Tag Line :</th>
                            <th colspan='3'><input class='tagline' autocomplete="false" placeholder='tagline'type="text" name='tagline' required=''></th>
                        </tr>
                    </table>
                </div>
                <div class='userdetails'>
                    <table>
                        <thead><u><h3>User creadentials</h3></u></thead>
                        <tr>
                            <th><p>Full name :</p></th>
                            <th><input type="text"  class='tagline'autocomplete="false"  name="fullname" required=""></th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th><p>Phone :</p></th>
                            <th><input type="text" name="phone" autocomplete="false" class='tagline' required="" ></th>
                        </tr>
                        <tr>
                            <th><p> Email :</p></th>
                            <th><input type="email" name="email"  class='tagline' required=''></th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th><p> LinkedIN : </p></th>
                            <th><input type="text" name="linkedin" autocomplete="false" class='tagline' required=''></th>
                        </tr>
                        <tr rowspan='3'>
                            <th colspan='1'><p>Address : </p></th>
                            <th colspan='4'><textarea name="address" autocomplete="false" class='tagline' cols="45" rows="3" placeholder='your Address' required=''></textarea></th>
                        </tr>
                        
                    </table>
                        <input type="submit" class='submitinp' name='user' value="submit">
                </div>
           </form>
        </div> 
    </div> 
    <div class="usedetails">
        <div class="usdetails">
            <?php 

              $usselect = "SELECT * FROM userdetails";
              $usresult = mysqli_query($conn,$usselect);
              $ustotal = mysqli_num_rows($usresult);

              if ($ustotal != 0){
                echo "<h3>"."Details"."</h3>";
                while($usvar = mysqli_fetch_assoc($usresult)){
                    echo "<div class='detailsloop'"."
                    <tr>
                    <td>".$usvar['fullname']." ,"."</td>
                    <td>".$usvar['phone']." ,"."</td>
                    <td>".$usvar['email']." ,"."</td>
                    <td>".$usvar['linkedin']." ,"."</td>
                    <td>".$usvar['addres']." ,"."</td>
                    <td>".$usvar['tagline']." ,"."</td>
                    <td>".$usvar['summary']." ,"."</td>
                    <td>"."<br>"."<a href='../updates/updateuser.php?var=$usvar[id]&fu=$usvar[fullname]&ph=$usvar[phone]&em=$usvar[email]&li=$usvar[linkedin]&ad=$usvar[addres]&tg=$usvar[tagline]&su=$usvar[summary]'><button>Edit</button></a>"."</td>
                    <td>"."<a href='../deletes/deleteuser.php?var=$usvar[id]'><button>Delete</button></a>
                    </tr>"."</br>"."</div>";
                }
            }else{
                echo '<style type= text/css> .usedetails {display:none}</style>';
            }
            ?>
        </div>
    </div>
        <div class="btn">
                <a href="home.php"><button class='first'>Back</button></a>
                <a href="education.php"><button class='second'>Next</button></a>
        </div>
</div>
 <?php
 if (isset($_POST['user'])){
        $summary = $_POST['summary'];
        $tagline = $_POST['tagline'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $linkedin = $_POST['linkedin'];
        $addres = $_POST['address'];

        $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

        if(!empty($summary) || !empty($tagline) || !empty($fullname) || !empty($phone) || !empty($email) || !empty($linkedin) || !empty($addres)){
           $SELECT = "SELECT email From userdetails Where email = ? Limit 1";
           $INSERT = "INSERT Into userdetails (summary,tagline,fullname,phone,email,linkedin,addres) values(?,?,?,?,?,?,?)";

           $var = $conn->prepare($SELECT);
           $var->bind_param("s",$email);
           $var->execute();
           $var->bind_result($email);
           $var->store_result();
           $rowa = $var->num_rows;

           if($rowa==0){
               $var->close();

               $var = $conn->prepare($INSERT);
               $var->bind_param("sssisss",$summary,$tagline,$fullname,$phone,$email,$linkedin,$addres);
               $var->execute();
               echo '<script type= "text/javascript">';
               echo 'alert("Data add success");';
               echo 'window.location.href = "resume.php"';
               echo  '</script>';
           } else{
            echo '<script type= "text/javascript">';
            echo 'alert("email already exists");';
            echo 'window.location.href = "resume.php"';
            echo  '</script>';
           }
           $var->close();
           $conn->close();

        }else{
            echo 'field required';
            die();
        }
    }
       
?>

</body>
</html>
 