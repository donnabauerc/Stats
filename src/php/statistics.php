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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
            <div id="content" style="margin: 10% 0% 0% 5%;">
                <button id="signoutButton" class="button logout"><a href='index.php?logout=true'>Signout</a></button>
                <div id="chartMaxSize" style="width: 500px;height: 500px;">
                    <canvas id="myChart" width="500" height="500"></canvas>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        //print all Entries
        $selectStatement = "SELECT date, purpose,type, value FROM entries WHERE user_id = '$user_id';";
        $result = $conn->query($selectStatement);

        if ($result->num_rows > 0) {
            $out = "<table><tr><th>Date:</th><th>Purpose:</th><th>Value:</th></tr>";

            while($row = $result->fetch_assoc()) {
                if($row["type"] == "payment"){
                    $out = $out."<tr bgcolor=\"#FF0000\"><td>" . $row["date"]. "</td><td>" . $row["purpose"]. "</td><td>-" . $row["value"]. "€</td></tr>";
                }else{
                    $out = $out."<tr bgcolor=\"#00FF00\"><td>" . $row["date"]. "</td><td>" . $row["purpose"]. "</td><td>+" . $row["value"]. "€</td></tr>";
                }
            }
            $out = $out."</table>";
            echo $out;
        } else {
            echo "0 results";
        }


        //get some facts
        $selectIncome = "SELECT sum(value) income FROM entries WHERE upper(type) like 'INCOME' AND user_id = '$user_id';";
        $selectExpense = "SELECT sum(value) as expense FROM entries WHERE upper(type) like 'PAYMENT' AND user_id = '$user_id';";

        $income = ($conn->query($selectIncome))->fetch_assoc();
        $expense = ($conn->query($selectExpense))->fetch_assoc();

        $balance = $income["income"]-$expense["expense"];
        $temp = $income["income"]+$expense["expense"];
        $percentIncome = round($income["income"]/$temp,2)*100;
        $percentExpense = round($expense["expense"]/$temp,2)*100;

        //echo script (and not a own js file) because of access to php vars
        echo "<script>
            var myChartObject = document.getElementById('myChart');
            var chart = new Chart(myChartObject,{
                type: 'doughnut',
                data: {
                    datasets: [{
                        label: 'Dataset 1',
                        backgroundColor: ['rgb(255,0,0)','rgb(0,255,0)'],
                        data: [".$percentExpense.",".$percentIncome."]
                    }],
                    labels:[
                        'Expense',
                        'Income'
                    ]
                },
                options: {
                    legend: {
                        labels: {
                            fontColor: \"white\",
                        }
                    }
                 }   
            });
        </script>";

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