<?php require 'EazitaMessaging.php'; ?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
</head>
<body>
<h2 align="center">Eazita Messaging Example</h2>

<?php
// Change your API_KEY & Eazita_Password
$ezsms = new Eazita("API_KEY","Eazita_Password");

if($_POST["to"] AND $_POST["from"] AND $_POST["msg"]){
foreach(explode(",",$_POST["to"]) as $id=>$recipient){
    $ezsms->build_send(['type' => $_POST["type"],'to' => $recipient,'from' => $_POST["from"],'msg' => $_POST["msg"]]);
}

$msg=$ezsms->execute_send(); 

echo "<div align='center'><table border='1'><tr><th>Status</th><th>Message ID</th><th>Recipient</th></tr>";
if(count($msg)>0){ foreach($msg as $recipient=>$resp){
    echo "<tr><td>".$resp['status']."</td><td>".$resp['messageid']."</td><td>".$recipient."</td></tr>";
} }
echo "</table></div>";

}else{ echo '<h3 align="center">Please fill the below form to send your message.</h3>'; }
?>

<form method="post">
<p align="center">Sender<br>
<input name="from" value="EZSMS" type="text"></p>
<p align="center">Message Type<br><select name="type">
<option value="text">Simple MSG</option>
<option value="unicode">Unicode (Multi Language)</option>
<option value="flash">Simple Flash</option>
<option value="flashunicode">Unicode Flash</option>
</select>
</p>
<p align="center">Recipient(s)<br>
<textarea name="to" style="margin: 2px; height: 100px; width: 340px;">Recipient number(s) must be in international number format without 0 or + and must be separated by comma sign (e.g. 923122699633,923121103792), duplicate numbers will be automatically ignore.</textarea></p>
<p align="center">Type Your Msg Here<br>
<textarea name="msg" style="margin: 2px; height: 145px; width: 310px;"></textarea></p>
<p align="center"><input type="submit" value="Submit"></form></p>


</body></html>
