<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $conn = new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_database']);

    if($conn->connect_error){
        echo ("Connection failed: " . $conn->connect_error);
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
                    <li class="effect" onclick="window.location.href='http://localhost/stats/src/php/index.php';"><a href="index.php">Home</a></li>
                    <li class="effect" onclick="window.location.href='http://localhost/stats/src/php/statistics.php';"><a href="statistics.php">Statistics</a></li>
                    <li class="effect" onclick="window.location.href='http://localhost/stats/src/php/entry.php';"><a href="entry.php">New Entry</a></li>
                    <li class="effect" onclick="window.location.href='http://localhost/stats/src/php/about.php';"><a href="about.php">About</a></li>
                </ul>
            </div>
            <div id="content">
                <button id="signoutButton" class="button logout"><a href='index.php?logout=true'>Signout</a></button>
                <div id="createDiv">
                    <h1>Create Payment/Income:</h1><br>
                    <form id="entry" action="" method="post" >
                        Name: <input type="text" name="name" id="name" required class="input" style="margin-left: 17px;"><br> <!-- necessary with purpose? -->
                        Type: <select name="type" form="entry" id="type" required class="input" style="margin-left: 25px;width: 243px;">
                            <option value="income">Income</option>      <!-- if income/payment is true only purposes for incomes/payments should be displayed-->
                            <option value="payment">Payment</option>
                        </select><br>
                        Purpose: <select name="purpose" form="entry" id="purpose" required class="input" style="width: 243px;">
                            <option value="food">Food</option>
                            <option value="clothes">Clothes</option>
                            <option value="work">Work</option>
                            <option value="other">Other</option>
                        </select><br>
                        Date: <input type="date" name="date" id="date" class="input" style="margin-left: 26px;width: 243px;"><br> <!-- zB.: 2019-04-16 -->
                        Value: <input type="text" name="value" id="value" required class="input" style="margin-left: 19px;width: 243px;"><br>
                        <input type="submit" class="ButtonLayout" name="submit" class="input" style="width: 311px;">
                    </form>
                    <span id="message"></span>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        //new Entry
        if(isset($_POST['submit'])) {
            $data = [$_POST['name'], $_POST['type'], $_POST['purpose'], $_POST['date'], $_POST['value']];
            $insertStatement = "INSERT INTO entries (entry_id, name, type, purpose, date, value, user_id) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$user_id');";
            $result = $conn->query($insertStatement);

            if($result){
                echo "<script>document.getElementById('message').textContent = 'Your Entry has been added successfully!';</script>";
            }else{
                echo "<script>document.getElementById('message').textContent = 'Sorry there has been a mistake!';</script>";
            }
        }
    }else{
        header('Location: http://localhost/stats/src/php/login.php');
    }

    if(isset($_GET["logout"])){
        session_destroy();
        session_unset();
        header('Location: http://localhost/stats/src/php/login.php');
    }

    $conn->close();
?>