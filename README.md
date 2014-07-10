Eazita PHP Script
=================

Sending SMS via Eazita SMS gateway.


Quick Examples
--------------

1) Send using prebuild messaging form (jsontest.php)

Edit jsontest.php
Change API KEY & Password

	$key="API_KEY"; //Your API KEY
	$pass="Eazita_Password"; Your Eazita Account Password

Now open jsontest.php & send your first message


2) Send SMS using simple plain API


	$sms=EazitaPlain('4t45','12345','','923122699633','eazita','Hello Hamza!');
	echo "$sms";


4) Send SMS using email to sms system


$eazita=emailtosms("923122699633","MySender","My Message","APIkey","Password","cpanel.eazita.com","MyEmail");
echo "$eazita";


How It Process:

Our email: number@emailtosms.serverlin.com

Add mobile number in email address before @ symbol.

example: 923122699633@emailtosms.serverlin.com

Type APIkey, cpanel.eazita.com and Password in subject area.

example: APIKEY{SPACE}cpanel.eazita.com{SPACE}PASSWORD

Type SenderID and Message in your email is message area.

example: EZSMS{SPACE}Hi it is a demo message


DEMO Example:
Email: 923122699633@emailtosms.serverlin.com
Email is subject: xxapikey cpanel.eazita.com MyPasswordIsHere
Email is message: MySender Hi there how are you?



3) Get delivery reports

Edit dlvr.php
Change API KEY & Password

	$key="API_KEY"; //Your API KEY
	$pass="Eazita_Password"; Your Eazita Account Password


NOTE: Must Use PHP Include Code in Webpages otherwise it will not work..:)
			
	include 'EazitaMessaging.php';
