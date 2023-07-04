<?php
include("connection.php");
//http://localhost/login/index3.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="style_register.css" type="text/css">
</head>
<body>
    <div id="form">
        <h1>Password Recovery Page</h1>
        <form name="form" action = "recoverpass.php" method="POST">
            <br><br>
            <label>Please enter new Password: </label><br>
            <input type="password" id="pass" name="pass"><br><br>
            <input type="submit" id="btn" value="Recover" name="submit">

            <p class='link'><a href='index.php'>Sign In</a></p>
            <p class='link'><a href='index2.php'>Register</a></p>
            
    </div>
</body>
</html>


