<?php

include 'Driver.php';
require '../vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;


//get data from the POST request
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];
$sessionId = $_POST["sessionId"];
$servicecode= $_POST["serviceCode"];

$level = 0;

$driver = new Driver();

$level = $driver->checkLevel($sessionId);

if ( $level == 0) {
    //This is the first request. Note how we start the response with CON
    $response = "CON Hello and welcome to Liz Loans. Before we begin, tell us more about yourself. First Name and Last name: \n";
    //now we graduate the user to the next level.
    $driver->insertLevel($sessionId,$phoneNumber,1);
}

else if($level==1){
    $driver->updateLevel($sessionId,2);
    $response = "CON Which loans would you prefer:\n";
    $response .= "One Month Loan:enter 1 \n";
    $response .= "Three Month Loan:enter 3 \n";

    }

else if($level == 2){
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
    
    
    // At this point you process your request and send an SMS confirmation

    require "sms.php";
    

}
header('Content-type: text/plain');
echo $response;
