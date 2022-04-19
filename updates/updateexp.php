<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
error_reporting(0);

$id = $_GET['var'];
$po = $_GET['po'];
$wo = $_GET['wo'];
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
<div class="fulexp">
    <div class="experience">
            <div class="experienceform">
                <form action="" method="GET">
                    <div class="exp">
                        <table>
                            <thead><h2>EXPERIENCE</h2></thead>
                                <tr>
                                    <th colspan='1'><p>Position:</p><br></th>
                                    <th colspan='3'><input type="text" name="position"  class='tagline' value='<?php echo "$po" ?>'></th>
                                </tr>
                                <tr rowspan='4'>
                                    <th><p>Work done :</p></th>
                                    <th colspan='3'><textarea name="workdone" class="tagline" cols="45" rows="4"  ><?php echo $wo; ?></textarea></th>
                                </tr>
                        </table>
                    </div>
                    <input type="submit" name="submit" value="update">
                </form>
            </div>
    </div>
</body>
<?php 
    if(isset($_GET['submit']))
    {
        $position = $_GET['position'];
        $workdone = $_GET['workdone'];

        $query = "UPDATE experience SET position='$position', workdone='$workdone' WHERE position = '$position'";
        $data = mysqli_query($conn,$query);

        if($data){
            echo '<script type= "text/javascript">';
            echo 'alert("Data add success");';
            echo 'window.location.href = "updateexp.php"';
            echo  '</script>';
            header("location: ../Resume/experience.php");
        }else{
            echo '<script type= "text/javascript">';
            echo 'alert("Data edit failed");';
            echo 'window.location.href = "updateexp.php"';
            echo  '</script>';
            header("location: ../Resume/experience.php");
        }

    }
?>
</html>