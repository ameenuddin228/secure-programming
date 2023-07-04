<?php
session_start();
include("connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\PHPMailer\src\Exception.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\SMTP.php';
if(isset($_POST['submit'])){
    $username = $_POST['username'];

    $sql = "SELECT * FROM user WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Fetch_username, $pass, $saltnum, $Fetch_email);
        
        if(mysqli_stmt_fetch($stmt) && $newpassword!="") {
            $aftersalt = $newpassword . $saltnum;
            $hash = hash('sha256', $aftersalt);
        } 
        mysqli_stmt_close($stmt);
    }

    $_SESSION['username'] = $Fetch_username;
    $_SESSION['email'] = $Fetch_email;

    if($username == $Fetch_username){
        $mail = new PHPMailer(TRUE);
        // Settings
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';

        $mail->Host       = "smtp-relay.sendinblue.com"; 
        $mail->SMTPDebug  = 0;                     
        $mail->SMTPAuth   = true;                  
        $mail->Port       = 587;                   
        $mail->Username   = "pakkassim00@gmail.com"; 
        $mail->Password   = "y6HSGE2NkFKdvO1s";        
        $mail->setFrom('pakkassim00@gmail.com', 'Ameen');
        $mail->addReplyTo('pakkassim00@gmail.com', 'Ameen');
        $mail->addAddress($Fetch_email, $Fetch_username);
        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Password Reset Request for Website';
        $mail->Body    = 'Your password can be reset by clicking the link below. If you did not request a new password, please ignore this email
        <br><br> Please click this link to change new password: http://localhost/login/index3.php';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<script>alert("Please check your email!")</script>';
    } else {echo "invalid username";}

    if ($mail->send()) {
        echo 'Email sent successfully.';
    } else {
        echo 'Error sending email: ' . $mail->ErrorInfo;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
    input{
    border:1px solid olive;
    border-radius:5px;
    }
    h1{
    color:darkgreen;
    font-size:22px;
    text-align:center;
    }
    body{
    background-color:lightblue;
    }

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h1 align="center">Forgot Passowrd</h1>
    <form action="" method="post">
        <table cellspacing="5" align="center">
            <tr><td>Username: </td><td><input type="text" name="username"/></td></tr>
            <tr><td></td><td><input type="submit" name="submit" value="Submit"/></td></tr>
        </table>
        <p class='link'><a href='index.php'>Sign In</a></p>
        <p class='link'><a href='index2.php'>Register</a></p>
    </form>
</body>
</html>