<?php
session_start();
$conn = mysqli_connect('localhost','root','','dbresumebuilder') or die('Unable to connect');
error_reporting(0);

$fu = $_GET['fu'];
$ph = $_GET['ph'];
$em = $_GET['em'];
$li = $_GET['li'];
$ad = $_GET['ad'];
$tg = $_GET['tg'];
$su = $_GET['su'];

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
        <a href="../home.php" ><button> HOME</button></a>
        <a href="../Resume/resume.php" class='active'><button>RESUME</button></a>
        <a href="../logout.php"><button>LOGOUT</button></a>
    </nav>
<div class="fullresumeuser">
    <div class="resumeuser">
        <h1>EDIT User Details</h1>
        <div class="resumeclass">
            <form  action="" method="GET">
        
                <div class="moto">
                    <table>
                        <thead><u><h3>About</h3></u></thead>
                        <tr rowspan='3'>
                            <th colspan='1'>Summary :</th>
                            <th colspan='3'><textarea name="summary" type="text"  class='tagline' cols="45" rows="4" required=''><?php echo $su; ?></textarea></th>
                        </tr>
                        <tr>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan='1'>Tag Line :</th>
                            <th colspan='3'><input class='tagline' value='<?php echo "$tg" ?>' type="text" name='tagline' required=''></th>
                        </tr>
                    </table>
        </div>
                <div class='userdetails'>
                    <table>
                        <thead><u><h3>User creadentials</h3></u></thead>
                        <tr>
                            <th><p>Full name :</p></th>
                            <th><input type="text" value='<?php echo "$fu" ?>' class='tagline'  name="fullname" required=""></th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th><p>Phone :</p></th>
                            <th><input type="text" name="phone" value='<?php echo "$ph" ?>' class='tagline' required="" ></th>
                        </tr>
                        <tr>
                            <th><p> Email :</p></th>
                            <th><input type="email" name="email"  class='tagline'value='<?php echo "$em" ?>' required=''></th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th><p> LinkedIN : </p></th>
                            <th><input type="text" name="linkedin" value='<?php echo "$li" ?>' class='tagline' required=''></th>
                        </tr>
                        <tr rowspan='3'>
                            <th colspan='1'><p>Address : </p></th>
                            <th colspan='4'><textarea  type="text" name="address"  class='tagline' cols="45" rows="3"  required=''><?php echo $ad; ?></textarea></th>
                        </tr>
                        
                    </table>      
                </div>
                <input type="submit" class='submitinp' name='user' value="submit">
           </form>
        </div> 
    </div> 
    </body>
<?php 
    if(isset($_GET['user']))
    {
        $fullname = $_GET['fullname'];
        $phone = $_GET['phone'];
        $email = $_GET['email'];
        $linkedin = $_GET['linkedin'];
        $addres = $_GET['address'];
        $tagline = $_GET['tagline'];
        $summary = $_GET['summary'];

        $query = "UPDATE userdetails SET fullname='$fullname', phone='$phone',email='$email',linkedin='$linkedin',addres='$addres',tagname='$tagname',fullname='$summary' WHERE position = '$position'";
        $data = mysqli_query($conn,$query);

        if($data){
            echo '<script type= "text/javascript">';
            echo 'alert("Data add success");';
            echo 'window.location.href = "updateuser.php"';
            echo  '</script>';
            header("location: ../Resume/resume.php");
        }else{
            echo '<script type= "text/javascript">';
            echo 'alert("Data edit failed");';
            echo 'window.location.href = "updateuser.php"';
            echo  '</script>';
            header("location: ../Resume/resume.php");
        }

    }
?>
</html>