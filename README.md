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


3) Get delivery reports

Edit dlvr.php
Change API KEY & Password

	$key="API_KEY"; //Your API KEY
	$pass="Eazita_Password"; Your Eazita Account Password


NOTE: Must Use PHP Include Code in Webpages otherwise it will not work..:)
			
	include 'EazitaMessaging.php';
