<?php
    $_db_host = "localhost";
    $_db_datenbank = "stats";
    $_db_username = "user";
    $_db_passwort = "user";
    $conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>create Payment/Income:</h1><br>
        <form id="entry" action="" method="post" >
            Name: <input type="text" name="name" id="name" required><br> <!-- necessary with purpose? -->
            Type: <select name="type" form="entry" id="type" required>
                <option value="income">Income</option>      <!-- if income/payment is true only purposes for incomes/payments should be displayed-->
                <option value="payment">Payment</option>
            </select><br>
            Purpose: <select name="purpose" form="entry" id="purpose" required>
                <option value="food">Food</option>
                <option value="clothes">Clothes</option>
                <option value="work">Work</option>
                <option value="other">Other</option>
            </select><br>
            Date: <input type="date" name="date" id="date"><br> <!-- zB.: 2019-04-16 -->
            Value: <input type="text" name="value" id="value" required><br>
            <input type="submit"  name="submit">
        </form>

        <h1>get Payments/Incomes: </h1>
        <a href="index.php?showEntries=true"><button type="button">get Entries</button></a><br>

        <div id="chartMaxSize" style="width: 400px;height: 400px;">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script src="chart.js"></script>

    </body>
</html>
<?php
    if(isset($_POST['submit'])) {
        $data = [$_POST['name'], $_POST['type'], $_POST['purpose'], $_POST['date'], $_POST['value']];
        $entry = implode(',', $data);

        $insertStatement = "INSERT INTO entries (id, name, type, purpose, date, value) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]');";

    }

    if (isset($_GET['showEntries'])) {
        $selectStatement = "SELECT date, purpose,type, value FROM ENTRIES;";
        $result = $conn->query($selectStatement);

        if ($result->num_rows > 0) {
            $out = "<table><tr><th>date:</th><th>purpose:</th><th>value:</th></tr>";

            while($row = $result->fetch_assoc()) {
                if($row["type"] == "payment"){
                    $out = $out."<tr bgcolor=\"#FF0000\"><td>" . $row["date"]. "</td><td>" . $row["purpose"]. "</td><td>" . $row["value"]. "€</td></tr>";
                }else{
                    $out = $out."<tr bgcolor=\"#00FF00\"><td>" . $row["date"]. "</td><td>" . $row["purpose"]. "</td><td>" . $row["value"]. "€</td></tr>";
                }
            }
            $out = $out."</table>";
            echo $out;
        } else {
            echo "0 results";
        }
    }

    $selectIncome = "SELECT sum(value) income FROM ENTRIES WHERE upper(type) like 'INCOME';";
    $selectExpense = "SELECT sum(value) as expense FROM ENTRIES WHERE upper(type) like 'PAYMENT';";

    $income = ($conn->query($selectIncome))->fetch_assoc();
    $expense = ($conn->query($selectExpense))->fetch_assoc();
    $balance = $income["income"]-$expense["expense"];

    echo $expense["expense"]."<br>".$income["income"]."<br>". $balance;


    $conn->close();
?>