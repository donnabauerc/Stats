<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script>
            var nightMode = true;
            function darkmode(dark){
                if(dark){
                    document.getElementById("wrapper").style.backgroundColor = "black";
                    nightMode = false;
                }else{
                    document.getElementById("wrapper").style.backgroundColor = "white";
                    nightMode = true;
                }
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="nav">
                <ul id="navbar">
                    <li class="effect" style="background-color: #575FCF"><a href="index.php">Home</a></li>
                    <li class="effect"><a href="statistics.php">Statistics</a></li>
                    <li class="effect"><a href="entry.php">New Entry</a></li>
                    <li class="effect"><a href="about.php">About</a></li>
                </ul>
            </div>
            <div id="content">
                <button id="darkButton" onclick="darkmode(nightMode)">Night Mode</button>
            </div>
        </div>


        <?php
            if(!isset($_SESSION["user_id"])){
                header('Location: http://localhost/Stats/src/php/login.php');
            }
        ?>
    </body>
</html>


