<?php
function EazitaJSON($api,$pass,$code,$to,$from,$type,$msg)
{
    $data = array();
    $data['api'] = $api;
    $data['pass'] = $pass;
    $data['code'] = $code;
    $data['to'] = $to;
    $data['from'] = $from;
    $data['type'] = $type;
    $data['msg'] = $msg;
    
    $post_str = '';
    foreach($data as $key=>$val) {
    	$post_str .= $key.'='.urlencode($val).'&';
    }
    $post_str = substr($post_str, 0, -1);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://api.eazita.com/json' );
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $responce = curl_exec($ch);
    curl_close($ch );  
    $responce = strchr("$responce","[");;
    $responce =rtrim($responce,"}");
    return $responce;
}
function EazitaPlain($key,$pass,$code,$to,$from,$msg)
{
$eazitakey = urlencode($key);
$eazitapass = urlencode($pass);
$code = urlencode($code);
$to = urlencode($to);
$from = urlencode($from);
$msg = urlencode($msg);
$type = urlencode($type);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'http://api.eazita.com/plain?api='.$eazitakey.'&pass='.$eazitapass.'&code='.$code.'&type='.$type.'&to='.$to.'&from='.$from.'&msg='.$msg);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$chk= curl_exec ($ch);
if($chk==1) $responce="Message Successfully Send";
elseif($chk==-1) $responce="Fields Missing";
elseif($chk==-2) $responce="Invalid login detail";
elseif($chk==-3) $responce="Your balance is low";
elseif($chk==-4) $responce="Message Sending Failed";
return $responce;
}
function EazitaDLVR($api,$pass)
{
    $data = array();
    $data['api'] = $api;
    $data['pass'] = $pass;
    
    $post_str = '';
    foreach($data as $key=>$val) {
    	$post_str .= $key.'='.urlencode($val).'&';
    }
    $post_str = substr($post_str, 0, -1);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://api.eazita.com/dlvr' );
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $responce = curl_exec($ch);
    curl_close($ch );  
    $responce = urlencode($responce);
    $responce =str_replace("%7B%22delivery%22%3A","","$responce");
    $responce = urldecode($responce);
    $responce =rtrim($responce,"}");
    return $responce;
}

?>
