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
        <h1><?php echo ($_SESSION['Username'])?>, Let's start with your resume.</h1>
        <div class="educationform">
            <form action="education.php" method="POST">
            <table>
               <thead><u><h3>Education</h3></u></thead>
               <tr>
                   <th><p>School Name :</P></th>
                   <th><input type="text" name ="schoolname" class='tagline' placeholder='School Name'required=''></th>
               </tr>
               <tr>
                   <th><p>Location :</p></th>
                   <th><input type="text" name="location" class='tagline' placeholder='School Location' required=''></th>
               </tr>
               <tr>
                   <th><p>Branch :</p></th>
                   <th><input type="text" name="branch" class='tagline' placeholder="Field of Study"></th>
               </tr>
               <tr>
                   <th><p>Class :</p></th>
                   <th><input type="text" name="class" class='tagline' placeholder="year of Study"></th>
               </tr>
               <tr>
                   <th><p>Percentage :</p></th>
                   <th><input type="text" name="percentage" class='tagline' placeholder='your %' required=""></th>
               </tr>
               <tr>
                   <th><p>Start :</p></th>
                   <th><input type="month" name="start" class='tagline' required=""></th>
               </tr>
               <tr>
                   <th><p>End :</p></th>
                   <th><input type='month' name="end" class='tagline' required=""></th>
               </tr>
               <tr>
                   <th colspan='2'><input type="submit" name='edu' value="submit"></th>
               </tr>
           </table>
           
           </form>
        </div>
    </div>
    <div class='eddetails'>
           <div class="edudetails">
            <?php 

              $edselect = "SELECT * FROM education";
              $edresult = mysqli_query($conn,$edselect);
              $edtotal = mysqli_num_rows($edresult);
              

              if ($edtotal != 0){
                echo "<h3>"."Details"."</h3>";
                while($edvar = mysqli_fetch_assoc($edresult)){
                    echo "<div class='detailsloop'"."<tr>
                    <td>".$edvar['schoolname']."</td>
                    <td>".$edvar['location']."</td>
                    <td>".$edvar['branch']."</td>
                    <td>".$edvar['class']."</td>
                    <td>".$edvar['percentage']."</td>
                    <td>".$edvar['start']."</td>
                    <td>".$edvar['end']."</td>"."<br>"."
                    <td>"."<a href='../updates/updateedu.php?id=$edvar[id]&sc=$edvar[schoolname]&lo=$edvar[location]&br=$edvar[branch]&cl=$edvar[class]&per=$edvar[percentage]&st=$edvar[start]&ed=$edvar[end]'><button class='editloop'>Edit</button></a>"."</td>
                    <td>"."<a href='../deletes/deleteedu.php?var=$edvar[id]'><button class='deleteloop'>Delete</button></a>
                    </tr>"."<br>"."</div>";
                }
            }else{
                echo '<style type= text/css> .eddetails {display:none;}</style>';
            }
            ?>
        </div>
    </div>
        <div class="btn">
            <a href="resume.php"><button class='first'>Back</button></a>
            <a href="skills.php"><button class='second'>Next</button></a>
        </div>
</div>
</body>
</html>
<?php

if (isset($_POST['edu'])){
    $schoolname = $_POST['schoolname'];
    $location = $_POST['location'];
    $branch = $_POST['branch'];
    $class = $_POST['class'];
    $percentage = $_POST['percentage'];
    $start = $_POST['start'];
    $end = $_POST['end'];

   // $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

    if(!empty($schoolname) || !empty($location) || !empty($branch) || !empty($class) || !empty($percentage) || !empty($start) || !empty($end)){
       $SELECT = "SELECT schoolname From education Where schoolname = ? Limit 1";
       $INSERT = "INSERT Into education (schoolname,location,branch,class,percentage,start,end) values(?,?,?,?,?,?,?)";

       $var = $conn->prepare($SELECT);
       $var->bind_param("s",$schoolname);
       $var->execute();
       $var->bind_result($schoolname);
       $var->store_result();
       $rowa = $var->num_rows;

       if($rowa==0){
           $var->close();

           $var = $conn->prepare($INSERT);
           $var->bind_param("ssssiss",$schoolname,$location,$branch,$class,$percentage,$start,$end);
           $var->execute();
           echo '<script type= "text/javascript">';
           echo 'alert("Data add success");';
           echo 'window.location.href = "education.php"';
           echo  '</script>';
       } else{
        echo '<script type= "text/javascript">';
        echo 'alert("data exists");';
        echo 'window.location.href = "education.php"';
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