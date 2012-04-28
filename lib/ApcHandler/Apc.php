<?php
namespace ApcHandler;
/**
 * @about This library handles the functions of the APC for PHP object-oriented paradigm
 * @Author kinncj <kinncj@gmail.com>
 */
class Apc{

	private $keys = array();
	private $key = "ApcHandler:";

	private static $instance;

	public function addKey(Key $key){
		$this->keys[] = $key;
		return $this;
	}

	public function removeKey(Key $key){
		$keyName = $key->getName();
		if(apc_exists("{$keyName}")){
			return apc_delete("{$keyName}");
		}
		return false;
	}

	public function getKey(Key $key){
		return $this->getApcKey($key);
	}

	private function getApcKey(Key $key){
		$keyName = $key->getName();
		//if(apc_exists("{$keyName}")){
			return Key::getInstance("{$keyName}",apc_fetch("{$keyName}"));
		//}
		//return false;
	}

	public function store(){
		foreach($this->keys as $key){
			$keyName = $key->getName();
			apc_store("{$keyName}",$key->getValue(false));
		}
		return $this;
	}

}