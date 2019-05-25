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

        <link rel="stylesheet" type="text/css" href="../css/login.css">

        <script>
            function register(){
                document.getElementById('loginDiv').style.display = 'none';
                document.getElementById('registerDiv').style.display = 'block';
            }

            function login(){
                document.getElementById('loginDiv').style.display = 'block';
                document.getElementById('registerDiv').style.display = 'none';
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="accounts">
                <div id="loginDiv">
                    <h1>LogIn</h1>
                    <form id="login" method="post" action="">
                        Username: <input id="username_login" class="input" type="text" name="uname" required><br>
                        Password: <input type="password" class="input" name="password" required style="margin-left: 5px;"><br>
                        <input id="LoginSubmitButton" type="submit" value="LogIn" name="login" class="ButtonLayout">
                    </form>
                    <button id="registerButton" onclick="register()" class="ButtonLayout">create Account?</button>
                </div>
                <div id="registerDiv" style="display: none;">

                    <h1>Register: </h1>

                    <form id="register" method="post" action="">
                        Email: <input type="email" name="email" required class="input register_input" style="margin-left: 90px;"><br>
                        Username: <input type="text" name="uname" required class="input register_input" style="margin-left: 55px;"><br>
                        Password: <input type="password" name="password1" required class="input register_input" style="margin-left: 60px;"><br>
                        Retype Password: <input type="password" name="password2" required class="input register_input"><br>
                        <input id="RegisterSubmitButton" type="submit" value="Register" name="register" class="ButtonLayout" style="width: 195px;">
                    </form>
                    <button id="loginButton" class="ButtonLayout" onclick="login()" style="width: 195px;">LogIn with Existing</button>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    if(isset($_SESSION['user_id'])){
        header('Location: http://localhost/stats/src/php/index.php');
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

            header('Location: http://localhost/stats/src/php/index.php');
        }else{
            echo "Sorry, an error has ocurred! ";
        }
    }

    $conn->close();
?>