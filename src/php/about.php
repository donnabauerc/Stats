<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>
        <link rel="stylesheet" type="text/css" href="../css/substyle.css">
    </head>
    <body>
    <div id="wrapper">
        <div id="navdiv">
            <ul id="navbar">
                <li class="effect"><a href="index.php">Home</a></li>
                <li class="effect"><a href="statistics.php">Statistics</a></li>
                <li class="effect"><a href="entry.php">New Entry</a></li>
                <li class="effect"><a href="about.php">About</a></li>
            </ul>
        </div>
        <div id="content">
            <button id="signoutButton" class="button logout"><a href='index.php?logout=true'>Signout</a></button>
            <div id="about">
                <h1>The Developing: </h1>
                <p>The Stats Website is a open Source school project <br>
                    developed by the CEO Christian Donnabauer. The basic idea <br>
                    started to grow, because of a personal interest and not nowing <br>
                    any other options. The current state has been developed in about <br>
                    50 days. <br>
                    If you like what you see, feel free to let the devloper know, and <br>
                    for further information Contact him via email: <br>
                    christiandonnabauer.school@gmail.com
                </p>
            </div>
        </div>
    </div>
    </body>
</html>
<?php
    if(!isset($_SESSION['user_id'])){
        header('Location: http://localhost/stats/src/php/login.php');
    }

    if(isset($_GET["logout"])){
        session_destroy();
        session_unset();
        header('Location: http://localhost/stats/src/php/login.php');
    }
?>