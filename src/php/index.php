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
            //https://tympanus.net/Tutorials/CircleHoverEffects/
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
            <div id="navdiv">
                <ul id="navbar">
                    <li class="effect" style="background-color: #575FCF"><a href="index.php">Home</a></li>
                    <li class="effect"><a href="statistics.php">Statistics</a></li>
                    <li class="effect"><a href="entry.php">New Entry</a></li>
                    <li class="effect"><a href="about.php">About</a></li>
                </ul>
            </div>

            <div id="content">
                <button id="darkButton" onclick="darkmode(nightMode)">Night Mode</button>

                <div id="site_1" class="site">
                    <div id="content_text_1">
                    <h1>Hello World!</h1>
                    <p>You now do have access <br>
                        to ALL features of Stats!<br>
                        You can track your income <br>
                        and expenses. Go to New <br>
                        Entries and create one!</p>
                </div>
                </div>
                <div id="site_2" class="site">
                    <div id="circle_home" class="circle">
                        <img class="images" id="img_home" src="../media/home.jpg" >
                        <div id="home_value" class="hover_value"><h1 style="position:absolute;margin-left:135px;margin-top: 155px;">Home</h1></div>
                    </div>
                    <div id="circle_statistic" class="circle">
                        <img class="images" id="img_statistic" src="../media/statistics.jpg" >
                        <div id="statistic_value" class="hover_value"><h1 style="position:absolute;margin-left:105px;margin-top: 135px;text-align: center;">View your <br>Statistics</h1></div>
                    </div>
                    <div id="circle_newentry" class="circle">
                        <img class="images" id="img_newentry" src="../media/newentry.jpg" >
                        <div id="newentry_value" class="hover_value"><h1 style="position:absolute;margin-left:100px;margin-top: 135px;text-align: center;">Create a <br>New Entry</h1></div>
                    </div>
                </div>
                <div id="site_3" class="site"> </div>
            </div>
        </div>


        <?php
            if(!isset($_SESSION["user_id"])){
                header('Location: http://localhost/Stats/src/php/login.php');
            }
        ?>
    </body>
</html>


