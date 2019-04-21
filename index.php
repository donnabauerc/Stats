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
    </head>
    <body>
        <h1>Payment/Income:</h1><br>
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
            <input type="submit"  name="submit">
        </form>
    </body>
</html>
<?php
    if(isset($_POST['submit'])){
        $data = [$_POST['name'],$_POST['type'],$_POST['purpose'],$_POST['date']];
        $entry = implode(',',$data);

        $insertStatement = "INSERT INTO entries (id, name, type, purpose, date) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '$data[3]');";
        if ($_res = $conn->query($insertStatement)){
            echo "<br>Entry has been added to the database.";
        }else {
            echo "<br>No insertion into database";
        }
        $conn->close();
    }
?>