<?php

session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
error_reporting(0);
?>
<?php
   $selt = "SELECT fullname,phone,email,phone,linkedin,addres,summary,tagline FROM userdetails";
   $relt = $conn->query($selt);
   while($row = $relt->fetch_assoc()) {
    $fulname = $row["fullname"];
    $fullname = strtoupper($fulname);
    $phone = $row["phone"];
    $email = $row["email"];
    $addres = $row["addres"];
    $summary = $row["summary"];
    $tagline = $row['tagline'];
    $linkedin = $row['linkedin'];
  }
  
  $slt = "SELECT * FROM education";
  $rlt = mysqli_query($conn,$slt);
  $total = mysqli_num_rows($rlt);
//   $result = mysqli_fetch_assoc($rlt);
//   while($raw = $rlt->fetch_assoc()) {
//    $schoolname = $raw["schoolname"];
//    $location = $raw["location"];
//    $branch = $raw["branch"];
//    $percentage = $raw["percentage"];
//    $start = $raw["start"];
//    $end = $raw['end'];
//  }

//from rxperience table for experience section in resume
$expselect = "SELECT * FROM experience";
$expresult = mysqli_query($conn,$expselect);
$exptotal = mysqli_num_rows($expresult);

//from table project and for project section in resume.
$proselect = "SELECT * FROM project";
$proresult = mysqli_query($conn,$proselect);
$prototal = mysqli_num_rows($proresult);

//from table skills and for skill section in resume.
$skselect = "SELECT * FROM skills";
$skresult = mysqli_query($conn,$skselect);
$sktotal = mysqli_num_rows($skresult);


//from table imageup , for image.
$select = "SELECT * FROM imageup";
$qry = mysqli_query($conn,$select);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="css/resumeoutline.css" media='screen'>
    <link rel="stylesheet" href="print/resumeout.css" media="print">
</head>
<body>
    <nav>
        <a href="home.php" ><button> Home</button></a>
        <a href="Resume/resume.php" class='active'><button>Resume</button></a>
        <a href="logout.php"><button>Logout</button></a>
    </nav>
<div class="ful">
    <div class="top">
        <div class="top_child img">
            <div class = 'imag'>
            <?php
              $output = '';
               if (mysqli_num_rows($qry) < 1){
                echo '<style type= text/css> .imag {display:none;}</style>';
          }
          while($row = mysqli_fetch_array($qry)) {
             echo '<div  class="images" id="images">';
             echo "<img src='uploads/".$row['image']."' alt='img' width='100%' height='100%'>";
             echo '</div>';
          }
          ?>
          </div>
        </div>
        <div class="top_child name">
            <div class='righth'>
            <?php 
                echo '<h2>';
                echo $fullname;
                echo '</h2>'.'<br>';
            ?>
            </div>
        <div class='rightp'>
            <?php
             echo '<p>';
             echo '-'.' '.$tagline;
             echo '</p>';
            ?>
        </div>
        </div>
    </div>
    <div class="resumeoutline">
        <div class="userdetail">
            <u><h3>CONTACT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></u>
            <?php
                echo '<p>';
                echo $email;
                echo '</p>';
                echo '<p>';
                echo $phone;
                echo '</p>';
                echo '<p>';
                echo $linkedin;
                echo '</p>';
                echo '<p>';
                echo $addres;
                echo '</p>';

            ?>
        </div>
        <br>
        <br>
        <br>
        <div class="skill">
            <u><h3> SKILLS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></u>
            <?php 
            if ($sktotal != 0){
                while($skvar = mysqli_fetch_assoc($skresult)){
                    echo '<p>';
                    echo $skvar['skillname'];
                    echo '</p>';
                }
            }else{
                echo '<style type= text/css> .project {display:none;}</style>';
            }
            ?>
        </div>
            
    </div>
    <div class="right">
        <div class="summary">
            <h3>SUMMARY</h3>
            <?php
                   echo '<p>';
                   echo $summary;
                   echo '</p>';
            ?>
        </div>
        <div class="educa">
            <h3>EDUCATION</h3>
            <?php if ($total != 0){
              while(  $result = mysqli_fetch_assoc($rlt)){
                    echo "".strtoupper($result['class'])." - ".strtoupper($result['schoolname'])." "." "." ".strtoupper($result['branch'])." "." ".strtoupper($result['location'])." "."</br>"."persentage :".$result['percentage']." "."From"." ".$result['start']." - ".$result['end']."<br><br>";
              }
            }else{
                echo '<style type= text/css> .educa {display:none;}</style>';
            }
            ?>
        </div>
        </br>
        <div class="expe">
            <h3>EXPERIENCE</h3>
            <?php if ($exptotal != 0){
                while($expvar = mysqli_fetch_assoc($expresult)){
                    echo $expvar['position'].'<br>';
                    echo $expvar['workdone'].'<br>';
                }
            }else{
                echo '<style type= text/css> .expe {display:none;}</style>';
            }
            ?>
        </div>
        </br>
        <div class="project">
            <h3>Project</h3>
            <?php if ($prototal != 0){
                while($provar = mysqli_fetch_assoc($proresult)){
                    echo $provar['projectname'].'<br>';
                    echo $provar['projectinfo'].'<br>';
                }
            }else{
                echo '<style type= text/css> .project {display:none;}</style>';
            }
            ?>

        </div>
    </div>
</div>
    
</body>
</html>