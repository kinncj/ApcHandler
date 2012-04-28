<?php
namespace ApcHandler;
/**
 * @about This library handles the functions of the APC for PHP object-oriented paradigm
 * @Author kinncj <kinncj@gmail.com>
 */
class Apc{

	private $keys = array();
	private $ApcKeyName = "apchandler:";
	private static $instance;

	public function addKey(Key $key){
		$this->keys[] = $key;
		return $this;
	}

	public function removeKey(Key $key){
		$keyName = $this->ApcKeyName.$key->getName();
		if($this->KeyExists($key)){
			unset($key);
			return apc_delete("{$keyName}");
		}
		return false;
	}

	public function getKey(Key $key){
		return $this->getApcKey($key);
	}

	private function getApcKey(Key $key){
		$keyName = $this->ApcKeyName.$key->getName();
		$keyValue = apc_fetch("{$keyName}");
		if($this->keyExists($key)){
		    return Key::getInstance("{$keyName}",$keyValue);
		}
		return false;
	}

	private function KeyExists(Key $key){
		$keyName = $this->ApcKeyName.$key->getName();
		apc_fetch("{$keyName}",$keyExists);
		return $keyExists;
	}
	
	public function store(){
		foreach($this->keys as $key){
			$keyName = $this->ApcKeyName.$key->getName();
			$check = apc_store("{$keyName}",$key->getValue(false));
			if($check === false){
				return $check;
			}
		}
		return $this;
	}

}