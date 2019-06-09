<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $conn = new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_database']);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script>


        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <button id="signoutButton" class="button logout"><a href='index.php?logout=true'>Signout</a></button>

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
                    <div id="circle_home" class="circle" onclick="window.location.href='http://localhost/stats/src/php/entry.php';">
                        <img class="images" src="../media/new_Entry.png" >
                        <div id="home_value" class="hover_value"><h1 style="position:absolute;margin-left:135px;margin-top: 155px;">New Entry</h1></div>
                    </div>
                    <div id="circle_statistic" class="circle" onclick="window.location.href='http://localhost/stats/src/php/statistics.php';">
                        <img class="images" src="../media/show_entries.png" >
                        <div id="statistic_value" class="hover_value"><h1 style="position:absolute;margin-left:105px;margin-top: 135px;text-align: center;">View your <br>Statistics</h1></div>
                    </div>
                    <div id="circle_logout" class="circle logout" onclick="window.location.href='http://localhost/stats/src/php/index.php?logout=true';">
                        <img class="images"  src="../media/logout.png" >
                        <div id="logout_value" class="hover_value" ><h1 style="position:absolute;margin-left:130px;margin-top: 155px;">Logout</h1></div>
                    </div>
                </div>
                <div id="site_3" class="site"><div id="content_text_2">
                        <h1>How does Stats work?</h1>
                        <p>Stats is a completely safe way, <br>
                            to keep track of your finance situation.<br>
                            It is made for people, who wished to track <br>
                            their expenses & income, which isn't always <br>
                            related with banking accounts
                        </p>
                    </div></div>
                <div id="site_4" class="site"><div id="content_text_3">
                        <h1>Safety is number <br> one priority</h1>
                        <p>To insure the complete integrity of <br>
                            our customers data, we run our own <br>
                            Server with our own encrypted databases
                        </p>
                    </div></div>
            </div>
        </div>

        <?php

            if(!isset($_SESSION["user_id"])){
                header('Location: http://localhost/stats/src/php/login.php');
            }

            if(isset($_GET["logout"])){
                session_destroy();
                session_unset();
                header('Location: http://localhost/stats/src/php/login.php');
            }
        ?>
    </body>
</html>


