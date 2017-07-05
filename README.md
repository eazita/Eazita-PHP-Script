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



Check your Eazita balance
------------
Use getbalance() method to check your eazita account balance:
```php
$ezsms = new Eazita("API_KEY","PASSWORD");
$balance=$ezsms->getbalance();
echo "You have ".$balance['balance']." euros remaining.";
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
}else{ echo "Error code: ".$lookup['code'].", ".$lookup['message']; }
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
