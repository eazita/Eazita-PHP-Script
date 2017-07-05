<?php

class Eazita {
    protected $apikey;
    protected $pass;
    protected $request, $options;
    protected $base_url = "api.eazita.com";
    var $msg_type = array("text", "unicode", "flash", "flashunicode");
    var $hlr_packages = array("basic", "carrier", "cnam");
      
    function __construct($apikey,$pass,$options=array()){
        $this->apikey = urlencode($apikey);
        $this->pass = urlencode($pass);
        if(!is_numeric($options[max_throughout])) $this->options[max_throughout]=10;
        if(!$options[protocol]) $this->options[protocol]="https://";
        $this->pass = $pass;
    }
    
    function lookup($data){
        if(!$data[gsm]) return false;
        if($data[package]) if(!in_array($data[package],$this->hlr_packages)) return false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->options[protocol].$this->base_url."/lookup?api=".$this->apikey."&pass=".$this->pass."&package=".urlencode($data[package])."&gsm=".urlencode($data[gsm]));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        return json_decode(curl_exec($ch),true);
    }
    function getbalance(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->options[protocol].$this->base_url."/balance?api=".$this->apikey."&pass=".$this->pass);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        return json_decode(curl_exec($ch),true);
    }

    function build_send($data){
        if($this->request[$data[to]]) return false;
        if(!is_numeric($data[to])) return false;
        if($data[ccc]) if(!is_numeric($data[ccc])) return false;
        if(!$data[from] or !$data[msg]) return false;
        if($data[type]) if(!in_array($data[type],$this->msg_type)) return false;
        
        $this->req = 'api='.$this->apikey.'&pass='.$this->pass.'&';
        foreach($data as $key=>$val) { $this->req .= $key.'='.urlencode($val).'&'; }
        $this->request[$data[to]]=$this->req;
        return true;
    }


    function execute_send(){
        if(count($this->request)>0){
        $mh = curl_multi_init();
        $id=0;
        $tempdata=array();
        $curly=array();
        $result = array();
        foreach ($this->request as $resp => $data) {
        $curly[$id]=curl_init();
        $tempdata[$id]=$resp;
        curl_setopt($curly[$id], CURLOPT_URL,$this->options[protocol].$this->base_url."/json");
        curl_setopt($curly[$id], CURLOPT_HEADER,0);
        curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curly[$id], CURLOPT_POST,1);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $data);
        curl_multi_add_handle($mh, $curly[$id]);
        $id++;
        }
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while($running > 0);
        
        foreach($curly as $id => $c) {
            $temp=json_decode(curl_multi_getcontent($c),true);
            if($temp[messages][0]) $result[$tempdata[$id]] =$temp[messages][0];
            curl_multi_remove_handle($mh, $c);
        }
        }
        
        
        return $result;
    }
}
