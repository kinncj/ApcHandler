<?php
require_once "bootstrap.php";
use ApcHandler\Key;

use ApcHandler\Apc;

$apc = new Apc();
$key1 = Key::getInstance();

$keyValue1 = new \stdClass();
$keyValue1->val1 = "a";
$keyValue1->val2 = "b";
$key1->setName("TestKey1")->setValue($keyValue1);
$apc->add($key1);
var_dump(array("Cli"=>$apc->store()));
var_dump(array("Cli"=>$key1));var_dump(array("Cli"=>$key1->getValue()));
var_dump(array("Cli"=>$apc->getKey($key1)));