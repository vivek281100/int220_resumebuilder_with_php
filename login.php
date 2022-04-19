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
    <link rel="stylesheet" href="css/style.css">
    <title>Resume Builder</title>
</head>
<body>
<div class="login">
    <h2>Login</h2><hr>
    <div class="loginform">
        <form action="login.php " method = 'POST'>
            <table>
                <tr>
                    <th><p>Username :</p></th>
                    <th><input type="text" name="Username"  required=""></th>
                </tr>
                <tr>
                    <th><p>Password :</p></th>
                    <th><input type="password" name="Password"  required="" ></th>
                </tr>
                <tr>
                    <th colspan = '2'><input type="submit" name='login' value="Login"></th>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    if (isset($_POST['login'])){
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];

    $select = mysqli_query($conn," SELECT * FROM logindetails WHERE Username = '$Username' AND Password = '$Password'");
    $row = mysqli_fetch_array($select);

    if(is_array($row)) {
        $_SESSION['Username'] = $row['userName'];
        $_SESSION['Password'] = $row['password'];
    } else {
        echo '<script type= "text/javascript">';
        echo 'alert("Invalid Username or Password");';
        echo 'window.location.href = "login.php"';
        echo  '</script>';
    }
    }
    if(isset($_SESSION['Username'])){
        header("Location:home.php");
    }
?>
</body>
</html>