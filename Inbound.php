<?php
// Get HTTP POST Message Parameters
$from=$_POST[from];         // ex 923122699633
$to=$_POST[to];             // ex 923121103793
$message=$_POST[message];   // ex Message will here without keyword
$date=$_POST[date];         // ex 2014-11-29 13:51:42
$keyword=$_POST[keyword];   // ex SMS keyword if exist

// This is optional to send response message to user.
// Remember auto response message should not more than 1 page.
// This feature is not supported for all accounts/inbound numbers.
$responce['respond']="Hi this is a test msg\nThis text is on a new line";

// Converting auto response message into JSON
echo json_encode($responce);
?>
