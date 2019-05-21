<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['db_host'] = "localhost";
    $_SESSION['db_database'] = "stats";
    $_SESSION['db_username'] = "user";
    $_SESSION['dp_password'] = "user";

    $conn = new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['dp_password'], $_SESSION['db_database']);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>

        <script>
            function register(){
                document.getElementById('loginDiv').style.display = 'none';
                document.getElementById('registerDiv').style.display = 'block';
            }
        </script>
    </head>
    <body>
        <div id="auccounts">

            <div id="loginDiv">

                <h1>LogIn</h1>

                <form id="login" method="post" action="">
                    Username: <input type="text" name="uname" required><br>
                    Password: <input type="password" name="password" required><br>
                    <input type="submit" value="LogIn" name="login">
                </form>

                <p id="registerSpan" style="cursor: pointer;" onclick="register()">create Account?</p>
            </div>

            <div id="registerDiv" style="display: none;">

                <h1>Register: </h1>

                <form id="register" method="post" action="">
                    Email: <input type="email" name="email" required><br>
                    Username: <input type="text" name="uname" required><br>
                    Password: <input type="password" name="password1" required><br>
                    Retype Password: <input type="password" name="password2" required><br>
                    <input type="submit" value="Register" name="register">
                </form>

            </div>
        </div>

    </body>
</html>
<?php
    if(isset($_SESSION['user_id'])){
        header('Location: http://localhost/Stats/src/php/index.php');
    }

    if(isset($_POST['login'])){
            validateUser($_POST["uname"], $_POST["password"], $conn);
    }

    if(isset($_POST['register'])){
            //validation of passwords is still missing

            if($_POST['password1'] == $_POST['password2'])
            $register_user = [$_POST['email'], $_POST['uname'], $_POST['password1']];
            $user = [$register_user[1], $register_user[2]];

            $registerStatement = "INSERT INTO user (id, username, password, email) VALUES ('', '$register_user[1]', '$register_user[2]', '$register_user[0]');";
            $result = $conn->query($registerStatement);

            if(!$result){ //mithilfe Unique Constraints: username, email
                echo '<br> Sorry, there was an error creating your account! Username or Email are used!';
            }else{
                validateUser($register_user[1],$register_user[2], $conn);

                $_SESSION['username'] = $register_user[1];
                $_SESSION['email'] = $register_user[0];

                include "mail.php";

                if ($mail->send()) {
                    validateUser($register_user[1], $register_user[2], $conn);
                }
            }
    }

    function validateUser($username, $password, $conn){
        $loginStatement = "SELECT * from user  WHERE username like ('$username') AND password like ('$password');";
        $result = $conn->query($loginStatement);

        if($result->num_rows > 0){
            $user = ($result->fetch_assoc());

            $_SESSION['user_id'] = $user["id"];

            header('Location: http://localhost/Stats/src/php/index.php');
        }else{
            echo "Sorry, an error has ocurred! ";
        }
    }

    $conn->close();
?>