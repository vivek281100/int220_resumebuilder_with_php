<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
$msg = '';
if(isset($_POST['upload'])) {
    $target = "uploads/".basename($_FILES['image']['name']);
        $file = $_FILES['image']['name'];

        $query = "INSERT INTO imageup(image) Values('$file')";
        mysqli_query($conn,$query);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "sucess";
        }else{
            $msg = 'Failed';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>resume</title>
</head>
<body>
    <nav>
        <a href="home.php" class='active'><button> Home</button></a>
        <a href="Resume/resume.php"><button>Resume</button></a>
        <a href="logout.php"><button>Logout</button></a>
    </nav>
<div class="imageup">
        <div class="imgform">
            <h2>IMAGE UPLOAD</h2>
            <div class="imgformcont">
            <form  method='POST' action='imageup.php'enctype='multipart/form-data'>
                <table>
                        <tr>
                            <th><input type="file" name="image" class="tagline" required=''></th>
                        </tr>
                </table>
                    <input type="submit" name='upload' value="upload">
            </form>
            </div>
        </div>
    <div class="imgdetails">
        <div class="imdetails">
            <?php 

                $imselect = "SELECT * FROM imageup";
                $imresult = mysqli_query($conn,$imselect);
                $imtotal = mysqli_num_rows($imresult);

                if ($imtotal === 2){
                    echo "<h3>"."Images"."</h3>";
                    echo "<h5>"."ONLY UPLOAD ONE IMAGE"."</h5>";
                    while($imvar = mysqli_fetch_assoc($imresult)){
                        echo "<div class='imgloop'"."<tr>
                        <td>"."<img src='uploads/".$imvar['image']."'></img>"."</td>"."<br>"."
                        <td>"."<a href='../edit.php?var=$imvar[id]'><button>Edit</button></a>"."</td>
                        <td>"."<a href='deletes/deleteimg.php?var=$imvar[id]'><button>Delete</button></a>
                        </tr>"."<br>"."</div>";
                }
                }
                elseif($imtotal != 0){
                    echo "<h3>"."Images"."</h3>";
                    while($imvar = mysqli_fetch_assoc($imresult)){
                        echo "<div class='imgloop'"."<tr>
                        <td>"."<img src='uploads/".$imvar['image']."'></img>"."</td>
                        <td>"."<a href='deletes/deleteimg.php?var=$imvar[id]'><button class='deleteloop'>Delete</button></a>
                        </tr>"."<br>"."</div>";
                        }
                }else{
                    echo '<style type= text/css> .imgdetails {display:none;}</style>';
                }
            ?>
        </div>
    </div>
    <div class="btn">
                <a href="Resume/experience.php"><button class='first'>Back</button></a>
                <a href="resumeoutput.php"><button class='second'>Next</button></a>
    </div>
</div>
</body>

</html>