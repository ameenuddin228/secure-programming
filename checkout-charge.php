<?php
require_once('C:\xampp\htdocs\login\vendor\stripe\stripe-php\init.php');
\Stripe\Stripe::setApiKey('sk_test_51NNRICBzKMqW3E4yPCIYfPPD2xklOuaMlFdoBAZVQkF9jT4m3yNe1ImIdOKQ46idVVtARgCmuPJcnHyj0mKwZNay00UZNqYl8H');

$orderId = $_POST['orderId'];
$stripeAmount = $_POST['amount'];
$stripeCurrency = 'myr';
$token = $_POST['stripeToken'];

try {
    $charge = \Stripe\Charge::create([
        'amount' => $stripeAmount,
        'currency' => $stripeCurrency,
        'description' => 'Pizza Order Payment',
        'source' => $token,
    ]);

    // Update the order status in the database or perform any other necessary actions
    // based on the successful payment

    // Redirect the user to a thank you or confirmation page
    header("Location: successpay.php");
    exit;
} catch (\Stripe\Exception\CardException $e) {
    $error = $e->getMessage();
    echo "Payment failed: $error";
}
?>
