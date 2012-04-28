<?php
session_start();
require_once 'bootstrap.php';
use ApcHandler\Key;
use ApcHandler\Apc;
if (isset($_POST['name']) && isset($_SESSION['user']) === false) {
    $_SESSION['user'] = $_POST['name'];
    echo json_encode(array("usercreated" => "created"));
    return true;
}
$apc = new Apc();
$key = new Key();
if (isset($_POST['message']) && isset($_SESSION['user'])) {
    $chat = $apc->getKey($key->setName("chat"));
    if(false === $chat){
    	$chat = array();    	
    }else{
    	$chat = $chat->getValue();
    }
    $chat[] = "{$_SESSION['user']} says: {$_POST['message']}\n";
    $key->setName("chat")->setValue($chat);
    $apc->addKey($key);
    $apc->store();  
}