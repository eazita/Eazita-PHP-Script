Eazita-PHP-Script
=================

Sending SMS via the Eazita SMS gateway.


Quick Examples
--------------

1) Send using prebuild messaging form (jsontest.php)

	Edit jsontest.php
	Change API KEY & Password
	$key="API_KEY"; //Your API KEY
	$pass="Eazita_Password"; Your Eazita Account Password
	Now open jsontest.php & send your first message


2) Send SMS using simple plain API

	$sms=EazitaPlain('4t45','12345','92','3122699633','eazita','Hello Hamza!');
	echo "$sms";

			NOTE: Must Use PHP Include Code in Webpages otherwise it will work..:)
			
						<?php include 'EazitaMessaging.php'; ?>

