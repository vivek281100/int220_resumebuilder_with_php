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
<div class="fulpro">
    <div class="projectform">
            <h1><u>PROJECTS</u></h1>
                <div class="projectformcont">
                    <form action="project.php" method="POST">
                        <table>
                            <tr>
                                <th colspan='1'><p>Project Name :</p></th>
                                <th colspan='2'><input type="text" name="projectname" class="tagline" placeholder='Name of Project'required=''></th>
                            </tr>
                            <tr rowspan='4'>
                                <th colspan='3'><textarea name="projectinfo" class="tagline" cols="45" rows="4" placeholder='Enter project details' required=''></textarea></th>
                            </tr>
                            <tr>
                                <th colspan = '5'><input type="submit" name='project' value="submit"></th>
                            </tr>
                        </table>
                    </form>
                </div>
    </div>
    <div class="prodetails">
            <div class="prdetails">
                <?php 

                    $prselect = "SELECT * FROM project";
                    $prresult = mysqli_query($conn,$prselect);
                    $prtotal = mysqli_num_rows($prresult);

                    if ($prtotal != 0){
                        echo "<h3>"."Details"."</h3>";
                        while($prvar = mysqli_fetch_assoc($prresult)){
                            echo "<div class='detailsloop'"."
                                <tr>
                                <td>".$prvar['projectname']."</td>
                                <td>".$prvar['projectinfo']."</td>"."<br>
                                <td>"."<a href='../updates/updatepro.php?var=$prvar[id]&pr=$prvar[projectname]&pi=$prvar[projectinfo]'><button class='editloop'>Edit</button></a>"."</td>
                                <td>"."<a href='../deletes/deleteexp.php?var=$prvar[id]'><button class='deleteloop'>Delete</button></a>
                                </tr>"."</br>"."</div>";
                            }
                    }else{
                        echo '<style type= text/css> .prodetails {display:none;}</style>';
                    }
                ?>
            </div>
    </div>
    <div class="btn">
                <a href="skills.php"><button class='first'>Back</button></a>
                <a href="experience.php"><button class='second'>Next</button></a>
    </div>
</div>
</body>
</html>
<?php

if (isset($_POST['project'])){
    $projectname = $_POST['projectname'];
    $projectinfo = $_POST['projectinfo'];
    

   // $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

    if(!empty($projectname) || !empty($projectinfo)){
       $SELECT = "SELECT projectname From project Where projectname = ? Limit 1";
       $INSERT = "INSERT Into project (projectname,projectinfo) values(?,?)";

       $var = $conn->prepare($SELECT);
       $var->bind_param("s",$projectname);
       $var->execute();
       $var->bind_result($projectname);
       $var->store_result();
       $rowa = $var->num_rows;

       if($rowa==0){
           $var->close();

           $var = $conn->prepare($INSERT);
           $var->bind_param("ss",$projectname,$projectinfo);
           $var->execute();
           echo '<script type= "text/javascript">';
           echo 'alert("Data add success");';
           echo 'window.location.href = "project.php"';
           echo  '</script>';
       } else{
        echo '<script type= "text/javascript">';
        echo 'alert("data exists");';
        echo 'window.location.href = "project.php"';
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