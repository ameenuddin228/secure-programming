<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_login.css" type="text/css">
</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        <form name="form" action = "login.php" method="POST">
            <label >Username: </label>
            <input type="text" id="user" name="user"><br><br>
            <label>Password: </label>
            <input type="password" id="pass" name="pass">
            <br><br><br>
            <input type="submit" id="btn" value="Login" name="submit">
        </form>

        <p class='link'><a href='index2.php'>Register</a></p>
        <p class='link'> <a href='forgotpass.php'>Forgot Your Password?</a></p>
    </div>
</body>
</html>