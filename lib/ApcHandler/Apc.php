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
		if(apc_exists("{$this->ApcKeyName}{$keyName}")){
			return apc_delete("{$this->ApcKeyName}{$keyName}");
		}
		return false;
	}

	public function getKey(Key $key){
		return $this->getApcKey($key);
	}

	private function getApcKey(Key $key){
		$keyName = $key->getName();
		$keyValue = apc_fetch("{$this->ApcKeyName}{$keyName}",$keyExists);
		if($keyExists){
		    return Key::getInstance("{$this->ApcKeyName}{$keyName}",$keyValue);
		}
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