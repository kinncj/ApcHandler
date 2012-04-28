<?php
require_once "bootstrap.php";
use ApcHandler\Key;

use ApcHandler\Apc;

$apc = new Apc();
$key1 = Key::getInstance();

$keyValue1 = new \stdClass();
$keyValue1->name = "Test";
$keyValue1->val = "apc";

$key1->setName("TestKey1")->setValue($keyValue1);

$key2 = Key::getInstance();

$keyValue2 = new \stdClass();

$keyValue2->attr1 = "c";
$keyValue2->attr2 = $keyValue1;

$key2->setName("TestKey2")->setValue($keyValue2);

$apc->addKey($key1)->addKey($key2)->store();

$getValue1 = $apc->getKey($key1)->getValue();
$getValue2 = $apc->getKey($key2)->getValue();

var_dump($getValue1);
var_dump($getValue2);

$apc->removeKey($key1);
$apc->removeKey($key2);