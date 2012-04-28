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
var_dump($key1);var_dump($key1->getValue());
var_dump($apc->getKey($key1));