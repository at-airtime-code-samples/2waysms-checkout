<?php

include 'Driver.php';
require '../vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;


//get data from the POST request
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];
$sessionId = $_POST["sessionId"];
$servicecode= $_POST["serviceCode"];

//get the last part of the text

// $userResponse=trim(end($textArray));
$level = 0;
// $username ="ithafethi";
// $apiKey ="ef8258c6fa003a57263d3e060d8561b4df788865dc7f48cbad7e4f74d99f4d8a";

$driver = new Driver();

$level = $driver->checkLevel($sessionId);

if ( $level == 0) {
    //this is the very first level so we save the level to the db first then proceed to serve the first menu.
    $driver->insertLevel($sessionId,$phoneNumber,$level);
    //This is the first request. Note how we start the response with CON
    $response = "CON Hello and welcome to Liz Loans. Before we begin, tell us more about yourself. First Name and Last name: \n";
    //now we graduate the user to the next level.
    $driver->updateLevel($sessionId,1);
}

else if($level==1){
    $driver->updateLevel($sessionId,2);
    $response = "CON Which loans would you prefer:\n";
    $response .= "One Month Loan:enter 1 \n";
    $response .= "Three Month Loan:enter 3 \n";

    }

else if($level == 2){
    // $driver->updateLevel($sessionId,3);

    $textArray=explode('*', $text);
    $names = $textArray[0];
    $loanTime = $textArray[1];
    $date = date('Y-m-d');
        try{
            $driver->insertInfo($phoneNumber,$names,$loanTime, $date);
            $response = "END Your request has been received. We are reviewing and will revert with more information.";
            }
         catch(Exception $e) {
            echo "End: ".$e->getMessage();
            }
    
    
    // At this point you process your request and if the loan is approved you send a B2C request

//     $username   = "sandbox";
//     $apiKey     = "828172913521d3b62c0a4c931c4b703f822645793640bec7e0b3f10b1200e829";

//     $AT = new AfricasTalking($username, $apiKey);
//     $payments = $AT->payments();
//     $productName  = "liz";

//     // Set your mobile b2c recipients
//     $recipients = [[
//         "phoneNumber"  => "+254705336634",
//         "currencyCode" => "KES",
//         "amount"       => 5,
//         "reason"       => $payments::REASON["SALARY"],
//         "metadata"     => [
//             "name"     => "John Doe"
//         ]
//     ]];

// // That's it, hit send and we'll take care of the rest
//     try {
//         $results = $payments->mobileB2C([
//             "productName" => $productName,
//             "recipients"  => $recipients
//         ]);

//         print_r($results);
//     } catch(Exception $e) {
//         echo "Error: ".$e->getMessage();
//     }
    // DONE!!!
}
header('Content-type: text/plain');
echo $response;
