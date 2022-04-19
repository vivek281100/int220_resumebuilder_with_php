<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
?>

<?php

if (isset($_POST['skil'])){
    $skillname = $_POST['skillname'];
   
    

   // $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

    if(!empty($skillname)){
       $SELECT = "SELECT skillname From skills Where skillname = ? Limit 1";
       $INSERT = "INSERT Into skills (skillname) values(?)";

       $var = $conn->prepare($SELECT);
       $var->bind_param("s",$skillname);
       $var->execute();
       $var->bind_result($skillname);
       $var->store_result();
       $rowa = $var->num_rows;

       if($rowa==0){
           $var->close();

           $var = $conn->prepare($INSERT);
           $var->bind_param("s",$skillname);
           $var->execute();
           echo '<script type= "text/javascript">';
           echo 'alert("DONE");';
           echo 'window.location.href = "skills.php"';
           echo  '</script>';
       } else{
        echo '<script type= "text/javascript">';
        echo 'alert("not Added");';
        echo 'window.location.href = "skills.php"';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reseme</title>
</head>
<body>
<nav>
        <a href="../home.php" ><button> Home</button></a>
        <a href="Resume/resume.php" class='active'><button>Resume</button></a>
        <a href="../logout.php"><button>Logout</button></a>
    </nav>
<div class="fulskill">
    <div class="skillformcont">
        <h1><?php echo ($_SESSION['Username'])?>, Let's start with your resume.</h1>
        <div class="skill">
            <form action="skills.php" method="POST">
                <table>
                    <thead><h3>skills</h3></thead>
                    <tr>
                        <th colspan='1'><p>skill :</p><br></th>
                        <th colspan='2'><input type="text" name="skillname"  class="tagline" placeholder='enter skill'required=''></th>
                    </tr>
                    <tr>
                        <th colspan = '3'><input type="submit" name='skil' value="submit"></th>
                    </tr>
               
                </table>
           </form>
        </div>
    </div>
        <div class="skildetails">
            <div class='skdetails'>
            <?php 

              $skselect = "SELECT * FROM skills";
              $skresult = mysqli_query($conn,$skselect);
              $sktotal = mysqli_num_rows($skresult);

              if ($sktotal != 0){
                echo '<h3>'.'Details'.'</h3>';
                while($skvar = mysqli_fetch_assoc($skresult)){
                    echo "<div class='skdetailsloop'"."
                    <tr>
                    <td>".$skvar['skillname']."</td>
                    <td>"."<a href='../deletes/delete.php?var=$skvar[id]'><button class='deleteloop'>Delete</button></a>
                    </tr>"."<br>"."</div>";
                }
            }else{
                echo '<style type= text/css> .skildetails {display:none;}</style>';
            }
            ?>
            </div>
        </div>
        <div class="btn">
                <a href="education.php"><button class='first'>Back</button></a>
                <a href="project.php"><button class='second'>Next</button></a>
        </div>
</div>
</body>
</html>
<!-- <?php

// if (isset($_POST['skil'])){s0
//     $skillname = $_POST['skillname'];
   
    

//    // $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

//     if(!empty($skillname)){
//        $SELECT = "SELECT skillname From skills Where skillname = ? Limit 1";
//        $INSERT = "INSERT Into skills (skillname) values(?)";

//        $var = $conn->prepare($SELECT);
//        $var->bind_param("s",$skillname);
//        $var->execute();
//        $var->bind_result($skillname);
//        $var->store_result();
//        $rowa = $var->num_rows;

//        if($rowa==0){
//            $var->close();

//            $var = $conn->prepare($INSERT);
//            $var->bind_param("s",$skillname);
//            $var->execute();
//            echo '<script type= "text/javascript">';
//            echo 'alert("DONE");';
//            echo 'window.location.href = "skills.php"';
//            echo  '</script>';
//        } else{
//         echo '<script type= "text/javascript">';
//         echo 'alert("not Added");';
//         echo 'window.location.href = "skills.php"';
//         echo  '</script>';
//        }
//        $var->close();
//        $conn->close();

//     }else{
//         echo 'field required';
//         die();
//     }


// }
?> -->