<?php
require_once('C:\xampp\htdocs\login\vendor\stripe\stripe-php\init.php');
\Stripe\Stripe::setApiKey('sk_test_51NNRICBzKMqW3E4yPCIYfPPD2xklOuaMlFdoBAZVQkF9jT4m3yNe1ImIdOKQ46idVVtARgCmuPJcnHyj0mKwZNay00UZNqYl8H');
    session_start();
    include("connection.php");
    $pepperoniPrice = 5;
    $tunaPrice = 4;
    $bananaPrice = 6;
    $alohaPrice = 3;
    $durianPrice = 8;
    if(isset($_POST['submit'])){

        //Threat: Client-State Manipulation:
        //countermeasure: Validate and sanitize user inputs on the server-side to prevent manipulation of data.:
        //In order.php, before inserting the values into the database, validate and sanitize the inputs 
        //to prevent manipulation and ensure data integrity.

        $pepperoni = filter_var($_POST['pepperoni'], FILTER_VALIDATE_INT);
        $tuna = filter_var($_POST['tuna'], FILTER_VALIDATE_INT);
        $banana = filter_var($_POST['banana'], FILTER_VALIDATE_INT);
        $aloha = filter_var($_POST['aloha'], FILTER_VALIDATE_INT);
        $durian = filter_var($_POST['durian'], FILTER_VALIDATE_INT);

        if ($pepperoni === false || $tuna === false || $banana === false || $aloha === false || $durian === false) {
            //returns true if both the value and the type of the operands match
            echo "Invalid input. Please enter a valid quantity.";
            header("Location:homepage.php");
            exit;
        }
        //end here

        $user = $_SESSION['username'];

        //$sql = "INSERT into `pizza` (pepperoni,tuna,banana,aloha,durian,username) VALUES (?,?,?,?,?,?)";
        $sql = "INSERT INTO `pizza` (pepperoni, tuna, banana, aloha, durian, username, totalPrice, paymentStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


        if($stmt = mysqli_prepare($conn, $sql)){
            $totalPrice = ($pepperoni * $pepperoniPrice) + ($tuna * $tunaPrice) + ($banana * $bananaPrice) + ($aloha * $alohaPrice) + ($durian * $durianPrice);
            $paymentStatus = 'Paid';
            mysqli_stmt_bind_param($stmt, "iiiiisds", $pepperoni, $tuna, $banana, $aloha, $durian, $user, $totalPrice, $paymentStatus);
            //mysqli_stmt_bind_param($stmt, "iiiiis", $pepperoni, $tuna, $banana, $aloha, $durian,$user);
            mysqli_stmt_execute($stmt);
            $orderId = mysqli_insert_id($conn);
            $stripeAmount = $totalPrice * 100; // Convert the total price to cents
            $stripeCurrency = 'myr';
            

            echo "<div class='form'>";
            echo "<h3>Order success.</h3>";
            echo "<h4>Order Summary:</h4>";
            echo "<table border='1'>";
            echo "<thead><tr><th>Pizza Type</th><th>Quantity</th><th>Price</th></tr></thead>";
            echo "<tbody><tr><td>Pepperoni</td><td>$pepperoni</td><td>" . ($pepperoni * $pepperoniPrice) . " USD</td></tr>";
            echo "<tr><td>Tuna</td><td>$tuna</td><td>" . ($tuna * $tunaPrice) . " USD</td></tr>";
            echo "<tr><td>Banana</td><td>$banana</td><td>" . ($banana * $bananaPrice) . " USD</td></tr>";
            echo "<tr><td>Aloha</td><td>$aloha</td><td>" . ($aloha * $alohaPrice) . " USD</td></tr>";
            echo "<tr><td>Durian</td><td>$durian</td><td>" . ($durian * $durianPrice) . " USD</td></tr>";
            echo "<tr><td>Total Price</td><td colspan='2'>$totalPrice USD</td></tr></tbody>";
            echo "</table>";

            echo "<form action='checkout-charge.php' method='POST'>";
            echo "<input type='hidden' name='orderId' value='$orderId'>";
            echo "<input type='hidden' name='amount' value='$stripeAmount'>";
            echo "<script
            src='https://checkout.stripe.com/checkout.js' class='stripe-button'
            data-key='pk_test_51NNRICBzKMqW3E4yk368HvRTcy1Siu4t4xgQ0MXzdGdHRSKNmnai0dVhUm4dKo3uBNPuupzhOVqQSPSwaWgIRuW400LgUE2mDm'
            data-amount='$stripeAmount'
            data-name='Pizza Order'
            data-description='Order payment'
            data-currency='$stripeCurrency'
            data-locale='auto'>
        </script>";
        echo "</form>";


            echo "<p class='link'>Homepage <a href='homepage.php'>home</a></p>";
            echo "</div>";
        }else{
            echo "ERROR: Could not add order : ".mysqli_error($conn);
            echo "Please try again";
        }
        mysqli_stmt_close($stmt);
    }
?>