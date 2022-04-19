<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
error_reporting(0);

$pr = $_GET['pr'];
$pi = $_GET['pi'];
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
        <a href="../Resume/resume.php" class='active'><button>Resume</button></a>
        <a href="../logout.php"><button>Logout</button></a>
    </nav>
<div class="fulpro">
    <div class="projectform">
            <h1><u>PROJECTS</u></h1>
                <div class="projectformcont">
                    <form action="" method="GET">
                        <table>
                            <tr>
                                <th colspan='1'><p>Project Name :</p></th>
                                <th colspan='2'><input type="text" name="projectname" value='<?php echo "$pr" ?>' class="tagline" placeholder='Name of Project'required=''></th>
                            </tr>
                            <tr rowspan='4'>
                                <th colspan='3'><textarea name="projectinfo" class="tagline" cols="45" rows="4" placeholder='Enter project details' required=''><?php echo $pi; ?></textarea></th>
                            </tr>
                            <tr>
                                <th colspan = '5'><input type="submit" name='project' value="submit"></th>
                            </tr>
                        </table>
                    </form>
                </div>
    </div>
</body>
<?php 
    if(isset($_GET['submit']))
    {
        $projectname = $_GET['projectname'];
        $projectinfo = $_GET['projectinfo'];

        $query = "UPDATE project SET projectname='$projectname', projectinfo='$projectinfo' WHERE projectname = '$projectname'";
        $data = mysqli_query($conn,$query);

        if($data){
            echo '<script type= "text/javascript">';
            echo 'alert("Data add success");';
            echo 'window.location.href = "updatepro.php"';
            echo  '</script>';
            header("location: ../Resume/project.php");
        }else{
            echo '<script type= "text/javascript">';
            echo 'alert("Data edit failed");';
            echo 'window.location.href = "updatepro.php"';
            echo  '</script>';
            header("location: ../Resume/project.php");
        }

    }
?>
</html>