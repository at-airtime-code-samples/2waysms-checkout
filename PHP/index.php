<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Initialize the SDK
$username = "username";
$apikey = "api key";
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
    "reason"       => $payments::REASON["SALARY"],
    "metadata"     => [
        "name"     => "John Doe"
    ]
]];

// That's it, hit send and we'll take care of the rest
try {
    $results = $payments->mobileB2C([
        "productName" => $productName,
        "recipients"  => $recipients
    ]);

    print_r($results);
} catch(Exception $e) {
    echo "Error: ".$e->getMessage();
}