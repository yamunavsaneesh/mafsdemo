<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config ['ni_direct']['mode'] = 'live';


//This has to be enabled on your Sage Pay account
$config ['ni_direct']['currency'] = 'AED';



$config ['ni_direct']['enc']                  =    MCRYPT_RIJNDAEL_128;	       
$config ['ni_direct']['enc_mode']             =    MCRYPT_MODE_CBC;
$config ['ni_direct']['iv']                   =    "0123456789abcdef";

if ( $config ['ni_direct']['mode'] == "live" ){
  $config ['ni_direct']['merchant_id']          =    "201603151000001";
  $config ['ni_direct']['payment_url'] = "https://www.timesofmoney.com/direcpay/secure/PaymentTransactionServlet";
  $config ['ni_direct']['enc_key'] = "rwEHhzGwfGEuaqxG4xdPb319BRr61E1yu8sVGeiKTWk=";
 

}elseif ($config ['ni_direct']['mode'] == "test"){
  $config ['ni_direct']['merchant_id'] = "201504051000001";
  $config ['ni_direct']['payment_url'] = "https://test.timesofmoney.com/direcpay/secure/PaymentTransactionServlet";
  $config ['ni_direct']['enc_key'] = "wj8ghu5ciFJ0EumchahlTlbZYdWNqJi7nKNfmA1k9uc=";

}
 $config ['ni_direct']['success_url'] = "process/processpayment";
 $config ['ni_direct']['failure_url'] = "process/paymentsuccess";