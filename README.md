Eazita Library for PHP
=================

Sending SMS via Eazita SMS gateway.



Installation
------------

1) To use this library first you'll have to [created an Eazita account][signup].
2) Download this library into your hosting/server. however, you'll also need to ensure that PHP cURL is enabled in your hosting/server.


Usage
------------
Include library in your php file:

```php
require 'EazitaMessaging.php';
```


Send messages via Eazita API
------------
1) To send a message, First create Authentication with your API key and password:

```php
$ezsms = new Eazita("API_KEY","PASSWORD");
```


2) Then use build_send() method to build your message.

```php
$ezsms->build_send(['to' => 'Recipient','from' => 'EZSMS','type' => 'text','msg' => 'Test message from Eazita.']);
```
build_send() method will return boolean true if your message is successfully build.

You can also build multiple messaging requests: 

```php
$ezsms->build_send(['to' => 'Recipient_1','from' => 'EZSMS','type' => 'text','msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => 'Recipient_2','from' => 'EZSMS','type' => 'text','msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => 'Recipient_3','from' => 'EZSMS','type' => 'flash','msg' => 'Test message from Eazita.']);
```


3) Then use execute_send() to execute your request:

```php
$msg=$ezsms->execute_send();
```


4) The API response data can be accessed as array properties of the execute_send() method:
```php
if(count($msg)>0){ foreach($msg as $recipient=>$resp){
    echo "The status of message on ".$recipient." is ".$resp['status']." & the message id is ".$resp['messageid'].".";
} }
```



Full Code:
```php
$ezsms = new Eazita("API_KEY","PASSWORD");

$ezsms->build_send(['to' => 'Recipient_1','from' => 'EZSMS','type' => 'text','msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => 'Recipient_2','from' => 'EZSMS','type' => 'text','msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => 'Recipient_3','from' => 'EZSMS','type' => 'flash','msg' => 'Test message from Eazita.']);

$msg=$ezsms->execute_send();

if(count($msg)>0){ foreach($msg as $recipient=>$resp){
    echo "The status of message on ".$recipient." is ".$resp['status']." & the message id is ".$resp['messageid'].".";
} }
```


Check your Delivery Reports
------------
Use getdelivery() method to get your sms log:
```php
$ezsms = new Eazita("API_KEY","PASSWORD");
$sms_log=$ezsms->getdelivery(['messageid' => '564581,569398,569399']);
print_r($sms_log);
```


Check your Eazita balance
------------
Use getbalance() method to check your eazita account balance:
```php
$ezsms = new Eazita("API_KEY","PASSWORD");
$balance=$ezsms->getbalance();
echo "You have ".$balance['balance']." euros remaining.";
```



2-Factor Authentication (2FA)
------------
2FA is a cloud based number verification solution that confirms the identity of the user and protects the system from phishing or hacking attacks. This Verify API allows you to send a one-time PIN code by SMS and Voice Call. The user receives the PIN code and types it into the application to confirm the identity.

1) Send a verification code to start two-factor authentication or phone verification process:
```php
$ezsms = new Eazita("API_KEY","PASSWORD");

$start_verify=$ezsms->start_verify(['number' => '923122699633','brand' => 'Your-Company','expire' => '600']);
if($start_verify['code']==1){
echo "Verification process is started:</br>";
echo "Number Type: ".$start_verify['NumberType']."</br>";
echo "Number Continent: ".$start_verify['location']['continent']."</br>";
echo "Number Country: ".$start_verify['location']['country']."</br>";
echo "Number Formats: International: ".$start_verify['NumberFormat']['international'].", National: ".$start_verify['NumberFormat']['national']."</br>";
}else{ echo "Error code: ".$start_verify['code'].", ".$start_verify['error']."</br>"; }
```

2) Check the verification code that user has provided:
```php
$check_verify_code=$ezsms->check_verify_code(['number' => '923122699633','code' => '1234']);
if($check_verify_code['code']==1){
echo "Number Successfully verified:";
print_r($check_verify_code);
}else{ echo "Error code: ".$check_verify_code['code'].", ".$check_verify_code['error']."</br>"; }
```

3) Cancel the verification request:
```php
$cancel_verify=$ezsms->cancel_verify(['number' => '923122699633']);
if($cancel_verify['code']==1){
echo "Number verification request has canceled.</br>";
}else{ echo "Error code: ".$cancel_verify['code'].", ".$cancel_verify['error']."</br>"; }
```



Perform number loookup
------------
You can use Number lookup to gather information about phone numbers.
```php
$ezsms = new Eazita("API_KEY","PASSWORD");
$lookup=$ezsms->lookup(['package' => 'carrier','gsm' => '923122699633;923121103792']);
```
You can select your package on a per request, every package will output different results. Valid packages are basic, carrier & cnam.
You can also supply multiple GSM numbers on every request however basic package only support one number in every request.
```php
if($lookup[code]==1){
    foreach($lookup[data] as $id=>$data){
        print_r($data);
    }
}else{ echo "Error code: ".$lookup['code'].", ".$lookup['error']; }
```


Quick Example
--------------

Send SMS using prebuild messaging form (Example_SendSMS.php)

1) Edit Example_SendSMS.php & Change API_KEY & Eazita_Password with your credentials:

```php
$ezsms = new Eazita("API_KEY","Eazita_Password");
```

2) Now open Example_SendSMS.php & send your first messages.




[signup]: https://eazita.com/sign-up/
