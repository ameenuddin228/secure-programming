<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Add a debugging statement to confirm that the file is being accessed
echo "Debugging: checkout.php is being reached!";
require './vendor/autoload.php'
header('Content-Type',s'application/json');

// \Stripe\Stripe::setApiKey("sk_test_51NNRICBzKMqW3E4yPCIYfPPD2xklOuaMlFdoBAZVQkF9jT4m3yNe1ImIdOKQ46idVVtARgCmuPJcnHyj0mKwZNay00UZNqYl8H");
// $session = Stripe\Checkout\Session::create([...]);

$stripe = new Stripe\StripeClient("sk_test_51NNRICBzKMqW3E4yPCIYfPPD2xklOuaMlFdoBAZVQkF9jT4m3yNe1ImIdOKQ46idVVtARgCmuPJcnHyj0mKwZNay00UZNqYl8H");
$session = $stripe->checkout->sessions->create([
    "success_url"=> "http://localhost/login/successpay.php",
    "cancel_url" => "http://localhost/login/unsuccesspay.php",
    "payment_method_type"=>['card'],
    "mode" => 'payment',
    "line_items"=>[
        [
            "price_data" =>[
                "currency"=>"gbp",
                "product_data"=>[
                    "name"=>"Pizza Tune",
                    "description"=>"new tuna pizza"
                ],
                "unit_amount"=>5000
            ],
            "quantity"=>2
        ],
        //second item
        [
            "price_data" =>[
                "currency"=>"gbp",
                "product_data"=>[
                    "name"=>"Pizza Aloha",
                    "description"=>"new aloha pizza"
                ],
                "unit_amount"=>1000
            ],
            "quantity"=>1
        ]
    ]
]);

echo json_encode($session);


?>