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

$key2 = clone $key1;

$keyValue2 = clone $keyValue1;

$keyValue2->val1 = "c";
$keyValue2->val2 = $keyValue1;

$key2->setName("TestKey2")->setValue($keyValue2);

$apc->addKey($key1)->addKey($key2)->store();

$getValue1 = $apc->getKey($key1);
$getValue2 = $apc->getKey($key2);

var_dump($getValue1);
var_dump($getValue2);

$apc->removeKey($key1);
$apc->removeKey($key2);