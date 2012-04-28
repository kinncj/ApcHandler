<?php
namespace Tests;
require_once 'tests/ApcHandler/bootstrap.php';
use ApcHandler\Key as KeyClass;
class Key extends \PHPUnit_Framework_TestCase
{

    private $key;
    private $keyValue;

    public function __construct()
    {
        $this->key = new KeyClass();
        $this->keyValue = new \stdClass();
        $this->keyValue->value1 = "Testing";
        $this->keyValue->value2 = "with";
        $this->keyValue->value3 = "PHPUnit";
    }

    public function testSetName()
    {
        $this->key->setName("Test");
    }

    /**
     * @depends testSetName
     */
    public function testGetName()
    {
        $this->assertEquals("Test", $this->key->getName());
    }

    /**
     * @depends testSetName
     */
    public function testSetValue()
    {
        $this->key->setValue($this->keyValue);
    }

    /**
     * @depends testSetValue
     */
    public function testGetValue()
    {
        $key = $this->key->getValue();
        $keyValue1 = $key->value1;
        $keyValue2 = $key->value2;
        $keyValue3 = $key->value3;
        $this->assertEquals("Testing", $keyValue1);
        $this->assertEquals("with", $keyValue2);
        $this->assertEquals("PHPUnit", $keyValue3);
    }
}
