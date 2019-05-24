<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
// $username   = "sandbox";
// $apiKey     = "828172913521d3b62c0a4c931c4b703f822645793640bec7e0b3f10b1200e829";

$username = "ithafethi";
$apikey = "ef8258c6fa003a57263d3e060d8561b4df788865dc7f48cbad7e4f74d99f4d8a";
$AT         = new AfricasTalking($username, $apikey);
// Get the payments service
$sms   = $AT->sms();
$recipients = "+254705336634";
$message = "Thank You for signing up for Liz's Loan services. You initial loan limit is 1000 KES. To borrow monet send an SMS to 22384 begining with the words itha followed by the amount you want.E.g: Itha 1000. and we will send you the cash.";
// That's it, hit send and we'll take care of the rest
try {
    $results = $sms->send([
        "to" => $recipients,
        "message"  => $message
    ]);

    print_r($results);
} catch(Exception $e) {
    echo "Error: ".$e->getMessage();
}