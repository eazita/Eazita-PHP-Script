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


Sending Messages
------------
1) To send messages, First create Authentication with your API key and password:

```php
$ezsms = new Eazita("API_KEY","PASSWORD");
```

2) Then use build_send() method to build multiple messages.

```php
$ezsms->build_send(['to' => "Recipient",'from' => EZSMS,'msg' => 'Test message from Eazita.']);
```
You can also build multiple requests: 

```php
$ezsms->build_send(['to' => "Recipient_1",'from' => EZSMS,'msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => "Recipient_2",'from' => EZSMS,'msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => "Recipient_3",'from' => EZSMS,'msg' => 'Test message from Eazita.']);
```
3) Then use execute_send() to execute your request:

```php
$msg=$ezsms->execute_send();
```

Full Code:
```php
$ezsms = new Eazita("API_KEY","PASSWORD");

$ezsms->build_send(['to' => "Recipient_1",'from' => EZSMS,'msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => "Recipient_2",'from' => EZSMS,'msg' => 'Test message from Eazita.']);
$ezsms->build_send(['to' => "Recipient_3",'from' => EZSMS,'msg' => 'Test message from Eazita.']);

$msg=$ezsms->execute_send();
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
