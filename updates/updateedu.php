<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
error_reporting(0);

$sc = $_GET['sc'];
$lo = $_GET['lo'];
$br = $_GET['br'];
$cl = $_GET['cl'];
$per = $_GET['per'];
$st = $_GET['st'];
$ed = $_GET['ed'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Resume</title>
</head>

<body>
    <nav>
        <a href="../home.php" ><button> Home</button></a>
        <a href="Resume/resume.php" class='active'><button>Resume</button></a>
        <a href="../logout.php"><button>Logout</button></a>
    </nav>
<div class="fulledu">
    <div class="education">
        <h1>EDIT Education details</h1>
        <div class="educationform">
            <form action="" method="GET">
            <table>
               <thead><u><h3>Education</h3></u></thead>
               <tr>
                   <th><p>School Name :</P></th>
                   <th><input type="text" name ="schoolname" value='<?php echo "$sc" ?>' class='tagline' required=''></th>
               </tr>
               <tr>
                   <th><p>Location :</p></th>
                   <th><input type="text" name="location" class='tagline' value='<?php echo "$lo" ?>'  required=''></th>
               </tr>
               <tr>
                   <th><p>Branch :</p></th>
                   <th><input type="text" name="branch" class='tagline' value='<?php echo "$br" ?>' required=''></th>
               </tr>
               <tr>
                   <th><p>Class :</p></th>
                   <th><input type="text" name="class" class='tagline' value='<?php echo "$cl" ?>' required=''></th>
               </tr>
               <tr>
                   <th><p>Percentage :</p></th>
                   <th><input type="text" name="percentage" class='tagline' value='<?php echo "$per" ?>'  required=""></th>
               </tr>
               <tr>
                   <th><p>Start :</p></th>
                   <th><input type="month" name="start" class='tagline' value='<?php echo "$st" ?>' required=""></th>
               </tr>
               <tr>
                   <th><p>End :</p></th>
                   <th><input type='month' name="end" class='tagline' value='<?php echo "$ed" ?>' required=""></th>
               </tr>
               <tr>
                   <th colspan='2'><input type="submit" name='edu' value="submit"></th>
               </tr>
           </table>
           
           </form>
        </div>
    </div>
    </body>
<?php 
    if(isset($_GET['edu']))
    {
        $schoolname = $_GET['schoolname'];
        $location = $_GET['location'];
        $branch = $_GET['branch'];
        $class = $_GET['class'];
        $percentage = $_GET['percentage'];
        $start = $_GET['start'];
        $end = $_GET['end'];

        $query = "UPDATE education SET schoolname='$schoolname', location='$location',branch='$branch',class='$class',percentage='percentage',start='start',end='end' WHERE schoolname = '$schoolname'";
        $data = mysqli_query($conn,$query);

        if($data){
            echo '<script type= "text/javascript">';
            echo 'alert("Data add success");';
            echo 'window.location.href = "updateedu.php"';
            echo  '</script>';
            header("location: ../Resume/education.php");
        }else{
            echo '<script type= "text/javascript">';
            echo 'alert("Data edit failed");';
            echo 'window.location.href = "updateedu.php"';
            echo  '</script>';
            header("location: ../Resume/education.php");
        }

    }
?>
</html>