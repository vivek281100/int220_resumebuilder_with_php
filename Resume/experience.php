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
<div class="fulexp">
    <div class="experience">
            <div class="experienceform">
                <form action="experience.php" method="POST">
                    <div class="exp">
                        <table>
                            <thead><h2>EXPERIENCE</h2></thead>
                                <tr>
                                    <th colspan='1'><p>Position:</p><br></th>
                                    <th colspan='3'><input type="text" name="position"  class='tagline' placeholder='Leave blank if no Experience'></th>
                                </tr>
                                <tr rowspan='4'>
                                    <th><p>Work done :</p></th>
                                    <th colspan='3'><textarea name="workdone" class="tagline" cols="45" rows="4" placeholder='Leave blank if no Experience' ></textarea></th>
                                </tr>
                        </table>
                    </div>
                    <input type="submit" name='exp' value="Login">
                </form>
            </div>
    </div>
    <div class="expdetails">
        <div class="exdetails">
                    <?php 

                        $expselect = "SELECT * FROM experience";
                        $expresult = mysqli_query($conn,$expselect);
                        $exptotal = mysqli_num_rows($expresult);

                        if ($exptotal != 0){
                            echo "<h3>"."Details"."</h3>";
                            while($expvar = mysqli_fetch_assoc($expresult)){
                                echo "<div class='detailsloop'"."<tr>
                                <td>".$expvar['position']."</td>".","."
                                <td>".$expvar['workdone']."</td>"."<br>"."
                                <td>"."<a href='../updates/updateexp.php?var=$expvar[id]&po=$expvar[position]&wo=$expvar[workdone]'><button class='editloop'>Edit</button></a>"."</td>
                                <td>"."<a href='../deletes/deleteedu.php?var=$expvar[id]'><button class='deleteloop'>Delete</button></a>"."
                                </tr>"."<br>"."</div>";
                            }
                        }else{
                                echo '<style type= text/css> .expdetails {display:none;}</style>';
                            }
                    ?>
            </div>
    </div>
    <div class="btn">
                <a href="project.php"><button class= 'first'>Back</button></a>
                <a href="../imageup.php"><button class='second'>Next</button></a>
    </div>
</div>
</body>
</html>
<?php
    
if (isset($_POST['exp'])){
    $position = $_POST['position'];
    $workdone = $_POST['workdone'];
    

   // $conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');

    if(!empty($position) || !empty($workdone)){
       $SELECT = "SELECT position From experience Where position = ? Limit 1";
       $INSERT = "INSERT Into experience (position,workdone) values(?,?)";

       $var = $conn->prepare($SELECT);
       $var->bind_param("s",$position);
       $var->execute();
       $var->bind_result($position);
       $var->store_result();
       $rowa = $var->num_rows;

       if($rowa==0){
           $var->close();

           $var = $conn->prepare($INSERT);
           $var->bind_param("ss",$position,$workdone);
           $var->execute();
           echo '<script type= "text/javascript">';
           echo 'alert("DONE");';
           echo 'window.location.href = "experience.php"';
           echo  '</script>';
       } else{
        echo '<script type= "text/javascript">';
        echo 'alert("not Added");';
        echo 'window.location.href = "experirnce.php"';
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