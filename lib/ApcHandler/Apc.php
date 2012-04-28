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

	public function removeKey($key){
		$key = $this->getKeyName($key);
		if($this->KeyExists($key)){
			return apc_delete("{$key}");
		}
		return false;
	}

	public function getKey($key){
		$key = $this->getKeyName($key);
		return $this->getApcKey($key);
	}

	private function getKeyName($key){
		if($key instanceof Key){
			$key = $key->getName();
		}
		return $key;
	}
	
	private function getApcKey($key){
		$keyName = $this->getKeyName($key);
		$keyValue = apc_fetch("{$keyName}");
		if($this->keyExists($key)){
		    return Key::getInstance("{$keyName}",$keyValue);
		}
		return false;
	}

	private function KeyExists($key){
		$keyName =  $this->getKeyName($key);
		apc_fetch("{$keyName}",$keyExists);
		return $keyExists;
	}
	
	public function store(){
		foreach($this->keys as $key){
			$keyName = $this->ApcKeyName.$key->getName($key);
			$check = apc_store("{$keyName}",$key->getValue(false));
			if($check === false){
				return $check;
			}
		}
		return $this;
	}

}