<?php
    session_start();
    if (empty($_SESSION['username']) || empty($_SESSION['password'])) {
        header("Location: index.php");
        exit; // Ensure that the script stops executing after redirection
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_home.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <div id="form">
        <h1>Homepage</h1>
        <h2>Please order your pizza</h2>
            <br><br><br>
            <p class='link'><a href='index4.php'>Order your Pizza</a></p>
            
            <td><br>USERNAME: <?php echo $_SESSION['username']; ?><br></td>
            <td><br>HASH PASSWORD: <?php echo $_SESSION['password']; ?><br></td>
            
            <p class='link'>Click here to <a href='logout.php'>logout</a></p>

    </div>
    
</body>
</html>