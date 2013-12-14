<?php include 'EazitaMessaging.php'; ?>

<div align="center"><h1>Eazita Delivery Reports</h1>
<?php
$key="API_KEY";
$pass="Eazita_Password";
$res=EazitaDLVR("$key","$pass");
if($res== "-2")
{ echo "The API Key/password you supplied is either invalid or disabled";
} else {
if($res== "NO_RECORD")
{ echo "No New Delivery Reports";
} else {
echo "<table border='1'><tr><th>Message ID</th><th>Status</th><th>GSM Error</th></tr>";
$data=json_decode($res);
 for($i=0;$i<count($data);$i++)
 {
$id="".$data[$i]->id."";
$status="".$data[$i]->status."";
$gsmerror="".$data[$i]->gsmerror."";
echo "<tr><td>$id</td><td>$status</td><td>$gsmerror</td></tr>";
}
echo "</table>";
}}
?>
</div>
