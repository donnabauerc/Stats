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
            var data = {};

            function darkmode(dark){
                if(dark){
                    document.getElementById("wrapper").style.backgroundColor = "black";
                    nightMode = false;
                }else{
                    document.getElementById("wrapper").style.backgroundColor = "white";
                    nightMode = true;
                }
            }
            $(".logout").click(function(){
                    data['logout'] = true;
                    $.post("index.php", data);
                });

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
                <button id="darkButton" class="button" onclick="darkmode(nightMode)">Night Mode</button>
                <button id="signoutButton" class="button logout">Signout</button>

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
                        <img class="images" src="../media/new_Entry.png" >
                        <div id="home_value" class="hover_value"><h1 style="position:absolute;margin-left:135px;margin-top: 155px;">New Entry</h1></div>
                    </div>
                    <div id="circle_statistic" class="circle">
                        <img class="images" src="../media/show_entries.png" >
                        <div id="statistic_value" class="hover_value"><h1 style="position:absolute;margin-left:105px;margin-top: 135px;text-align: center;">View your <br>Statistics</h1></div>
                    </div>
                    <div id="circle_logout" class="circle logout">
                        <img class="images"  src="../media/logout.png" >
                        <div id="logout_value" class="hover_value" ><h1 style="position:absolute;margin-left:130px;margin-top: 155px;">Logout</h1></div>
                    </div>
                </div>
                <!--<div id="site_3" class="site">How does Stats work?</div>-->
            </div>
        </div>


        <?php

            if(!isset($_SESSION["user_id"])){
                header('Location: http://localhost/stats/src/php/login.php');
            }

            if(isset($_SESSION["logout"])){
                session_destroy();
                session_unset();
                header('Location: http://localhost/stats/src/php/login.php');
            }
        ?>
    </body>
</html>


