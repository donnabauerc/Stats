<?php
    require_once('login.php');

    $register_user = [];

    if (session_status() == PHP_SESSION_NONE) {
        header('Location: localhost/stats/src/php/login.php');
    }

    $conn = new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_database']);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    for($i = 0; $i < sizeof($_SESSION['register_user']);$i++){
        $register_user[$i] = $_SESSION['register_user'][$i];
    }

    $registerStatement = "INSERT INTO user (id, username, password, email) VALUES ('', '$register_user[1]', '$register_user[2]', '$register_user[0]');";
    $result = $conn->query($registerStatement);

    if($result){
        validateUser($register_user[1],$register_user[2], $conn);
    }


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>
    </head>
    <body style="text-align: center;font-family: Arial;">
        <h1 style="margin-top: 18%;">Success!</h1>
        <h3>You have been registered, <a href="index.php">Click Here</a> to use Stats!</h3>
    </body>
</html>
