<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require './vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;

    $mail->Username = "christiandonnabauer.school@gmail.com";
    $mail->Password = "SafePassword";
    $mail->setFrom('christiandonnabauer.school@gmail.com', 'Christian Donnabauer');
    $mail->addReplyTo('donnabauer.christian.01@gmail.com', 'Christian Donnabauer');

    $mail->addAddress($_SESSION["email"], $_SESSION["username"]);

    $mail->Subject = 'Stats Registration';
    $mail->msgHTML('<h1>Hello World!</h1><br><p>You have succesfully been registered for Stats!<br>Before using all the functions of Stats, <br> please confirm your account: <a href="http://localhost/stats/src/php/confirm.php">Click Here!</a> </p>');

    $mail->AltBody = 'Sorry, there has been a mistake!';

 ?>
