<?php
// read raw post data
$postdata = file_get_contents("php://input");

// extract important data
$postdata = urlencode($postdata);
$postdata =str_replace("%7B%22delivery%22%3A","","$postdata");
$postdata = urldecode($postdata);
$postdata =rtrim($postdata,"}");

// json decode
$data=json_decode($postdata);

// Write report of each message
 for($i=0;$i<count($data);$i++)
  {
echo "</br>MessageID: " . $data[$i]->id;
echo "</br>Status: " . $data[$i]->status;
echo "</br>Sentdate: " . $data[$i]->sentdate;
echo "</br>Donedate: " . $data[$i]->donedate;
echo "</br>GSMCode: " . $data[$i]->gsmerror . "</br>";
  }
?>
