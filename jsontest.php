<?php include 'EazitaMessaging.php'; ?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
</head>
<body>
<h1 align="center">Eazita JSON Messaging</h1>

<form method="post">
<p align="center">Country Code<br>
<input name="ccode" value="92" type="text"></p>
<p align="center">Sender<br>
<input name="from" value="eazita" type="text"></p>
<p align="center">Message Type<br><select name="type">
<option value="text">Simple MSG</option>
<option value="unicode">UNICode(Multi Language)</option>
</select>
</p>
<p align="center">Recipients<br>
<textarea name="to" style="margin: 2px; height: 100px; width: 340px;">Recipient number(s) must be in international number format without 0 or + (e.g. 923122699633).</textarea></p>
<p align="center">Type Your Msg Here<br>
<textarea name="msg" style="margin: 2px; height: 145px; width: 310px;"></textarea></p>
<p align="center"><input type="submit" value="Submit"></form></p>

<?php
$key="API_KEY";
$pass="Eazita_Password";

$code= $_POST["ccode"];
$to= $_POST["to"];
$type= $_POST["type"];
$from= $_POST["from"];
$msg= $_POST["msg"];
if($to== "")
{
} else {
if($from== "")
{
} else {
if($msg== "")
{
} else {

$responce=EazitaJSON("$key","$pass","$code","$to","$from","$type","$msg");
$data=json_decode($responce);
 for($i=0;$i<count($data);$i++)
 {
$status="".$data[$i]->status."";
$messageid="".$data[$i]->messageid."";
$to="".$data[$i]->gsm."";
echo "<div align='center'>";
echo "<table border='1'><tr><th>Message ID</th><th>Recipient</th><th>Status</th></tr><tr><td>$messageid</td><td>$to</td><td>$status</td></tr></table>";
echo "</div>";
}


}}}
?>
</body></html>
