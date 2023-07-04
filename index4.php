<?php
//Threat: Client-State Manipulation:
//checks whether the username key is not set in the $_SESSION superglobal array
//countermeasure : Use server-side sessions or tokens to track and verify user actions and prevent unauthorized modifications.

session_start();
include("connection.php");
if (!isset($_SESSION['username'])) {
    //true if the username key is not set in the session
    header("Location: index.php");
    exit;
}
//end here
//http://localhost/login/index3.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Pizza</title>
    <link rel="stylesheet" href="style_order.css" type="text/css">
</head>
<body>
    <div id="form">
        <h1>Please choose your Pizza!</h1>
        <form action="order.php" name="form"  method="POST" onsubmit="return confirmSubmit();">
            <table>
                <thead>
                    <tr>
                        <th>Pizza Type</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <td>Pepperoni</td>
                        <td><input type="number" id="pepperoni" name="pepperoni" min="0" value="0"onkeydown="return false;"></td>
                    </tr>
                    <tr>
                        <td>Banana</td>
                        <td><input type="number"id="banana" name="banana" min="0" value="0" onkeydown="return false;"></td>
                    </tr>
                    <tr>
                        <td>Hawaiian Tuna</td>
                        <td><input type="number" id="tuna" name="tuna"min="0" value="0" onkeydown="return false;"></td>
                    </tr>
                    <tr>
                        <td>Aloha</td>
                        <td><input type="number" id="aloha" name="aloha"min="0"min="0" value="0" onkeydown="return false;"></td>
                    </tr>
                    <tr>
                        <td>Durian</td>
                        <td><input type="number" id="durian" name="durian"min="0"min="0" value="0" onkeydown="return false;"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" id="btn" value="order" name="submit">Place Order</button>  
        </form>
    </div>
    <script>
        function confirmSubmit() {
            return confirm("Are you sure you want to place the order?"); 
        }
    </script>
          
          <p class='link'>Homepage <a href='homepage.php'>home</a></p>
</body>
</html>