<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
// $username   = "sandbox";
// $apiKey     = "828172913521d3b62c0a4c931c4b703f822645793640bec7e0b3f10b1200e829";

// Initialize the SDK
$username = "ithafethi";
$apikey = "ef8258c6fa003a57263d3e060d8561b4df788865dc7f48cbad7e4f74d99f4d8a";
$AT         = new AfricasTalking($username, $apikey);
// Initialize the SDK
// Get the payments service
$payments   = $AT->payments();

// Set the name of your Africa's Talking payment product
$productName  = "liz";
$text = $_POST["text"];
$textArray=explode(' ', $text);
$userResponse=trim(end($textArray));

// Set your mobile b2c recipients
$recipients = [[
    "phoneNumber"  => $_POST["from"],
    "currencyCode" => "KES",
    "amount"       => $userResponse,
    "metadata"     => [
        "name"     => "John Doe"
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