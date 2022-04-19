<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <a href="home.php" class='active'><button> Home</button></a>
        <a href="Resume/resume.php"><button>Resume</button></a>
        <a href="logout.php"><button>Logout</button></a>
    </nav>
<div class="fullhome"> 
    <div class="homecont">
            <div class="lefthome" >
                 <h1>Welcome <?php echo ($_SESSION['Username']); ?></h1>
             </div>
                 <div class="righthome">
                 <h3>About</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat odit pariatur</br>
                             asperiores sapiente excepturi maxime eos voluptas, volupta</br>
                            tum deserunt vitae dolorum! Illum ex recusandae ipsa qua
                            erat sed, consequuntur voluptas iusto!</p>
                    <h3>Servises</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum temporibus</br>, voluptatem cumque m
                         ollitia consequuntur natus corporis possimu
                            s sunt est saepe, perferendis m<br>
                        agni rem eos sequi, tempore enim? Perferendis, placeat vel!</p>
             </div>
    </div>
    <div class="btn">
            <a href="Resume/resume."><button class='second'>Next</button></a>
    </div>
</div>   
</body>
</html>