<?php
require_once 'bootstrap.php';
use ApcHandler\Key;
use ApcHandler\Apc;
$return = array("message"=>"");
$apc = new Apc();
$key = new Key("chat");
$chat = $apc->getKey($key);
if(false !== $chat){
	    $chat = $chat->getValue();
        $return = array("message"=>array_pop($chat));
}
echo json_encode($return);