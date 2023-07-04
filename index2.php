<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style_register.css" type="text/css">
</head>
<body>
    <div id="form">
        <h1>Register Form</h1>
        <form name="form" action = "register.php" method="POST">
            <label for="">Please enter new Username :</label><br>
            <input type="text" id="user" name="user"><br><br>
            <label for="">Please enter new Email address :</label><br>
            <input type="text" id="email" name="email"><br><br>
            <label>Please enter new Password: </label><br>
            <input type="password" id="pass" name="pass"><br><br>
            <input type="submit" id="btn" value="Register" name="submit">
            <p class='link'>Click here to <a href='index.php'>Login</a></p>
    </div>
</body>
</html>