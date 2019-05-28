<?php

require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

$username = "username";
$apikey = "API Key";

// Initialize the SDK
$AT         = new AfricasTalking($username, $apikey);
// Get the payments service
$payments   = $AT->payments();

// Set the name of your Africa's Talking payment product
$productName  = "Your product name";
$text = $_POST["text"];
$textArray=explode(' ', $text);
$userResponse=trim(end($textArray));

// Set your mobile b2c recipients
$recipients = [[
    "phoneNumber"  => $_POST["from"],
    "currencyCode" => "KES",
    "amount"       => $userResponse,
    "metadata"     => [
        "name"     => "Jane Doe"
    ]
]];

// That's it, hit send and we'll take care of the rest
try {
    $results = $payments->mobileCheckout([
        "productName" => $productName,
        "recipients"  => $recipients
    ]);

    print_r($results);
} catch(Exception $e) {
    echo "Error: ".$e->getMessage();
}