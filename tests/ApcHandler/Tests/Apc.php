<?php
namespace Tests;
require_once 'tests/ApcHandler/bootstrap.php';
use ApcHandler\Apc as ApcClass;
use ApcHandler\Key as KeyClass;
class Apc extends \PHPUnit_Framework_TestCase
{

    private $key;
    private $apc;
    private $keyValue;

    public function __construct()
    {
        $this->key = new KeyClass();
        $this->apc = new ApcClass();
        $this->keyValue = new \stdClass();
        $this->keyValue->value1 = "Testing";
        $this->keyValue->value2 = "with";
        $this->keyValue->value3 = "PHPUnit";
    }

    public function testStore()
    {
        $this->key->setName("Test");
        $this->key->setValue($this->keyValue);
        $this->apc->addKey($this->key);
        $store = $this->apc->store();
        $this->assertTrue($store instanceof ApcClass);
    }

    /**
     * @depends testStore
     */
    public function testGetKeyValues()
    {
        $key = $this->apc->getKey($this->key)->getValue();
        $keyValue1 = $key->value1;
        $keyValue2 = $key->value2;
        $keyValue3 = $key->value3;
        $this->assertEquals("Testing", $keyValue1);
        $this->assertEquals("with", $keyValue2);
        $this->assertEquals("PHPUnit", $keyValue3);
    }

    /**
     * @depends testGetKeyValues
     */
    public function testRemoveKey()
    {
        $result = $this->apc->removeKey($this->key);
        $this->assertTrue($result);
    }
}
