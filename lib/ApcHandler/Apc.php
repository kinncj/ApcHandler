<?php
namespace ApcHandler;
/**
 * @about This library handles the functions of the APC for PHP object-oriented paradigm
 * @Author kinncj <kinncj@gmail.com>
 */
class Apc{

	private $keys = array();
	private $ApcKeyName = "ApcHandler:";
	private static $instance;

	public function addKey(Key $key){
		$this->keys[] = $key;
		return $this;
	}

	public function removeKey(Key $key){
		$keyName = $key->getName();
		if($this->KeyExists($key)){
			return apc_delete("{$this->ApcKeyName}{$keyName}");
		}
		return false;
	}

	public function getKey(Key $key){
		return $this->getApcKey($key);
	}

	private function getApcKey(Key $key){
		$keyName = $key->getName();
		$keyValue = apc_fetch("{$this->ApcKeyName}{$keyName}");
		var_dump($keyValue);
		if($this->keyExists($key)){
		    return Key::getInstance("{$this->ApcKeyName}{$keyName}",$keyValue);
		}
		return false;
	}

	private function KeyExists(Key $key){
		$keyName = $key->getName();
		apc_fetch("{$this->ApcKeyName}{$keyName}",$keyExists);
		return $keyExists;
	}
	
	public function store(){
		foreach($this->keys as $key){
			$keyName = $key->getName();
			apc_store("{$this->ApcKeyName}{$keyName}",$key->getValue(false));
		}
		return $this;
	}

}