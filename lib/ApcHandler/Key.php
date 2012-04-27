<?php
namespace ApcHandler;
/**
 * @about This library handles the functions of the APC for PHP object-oriented paradigm
 * @Author kinncj <kinncj@gmail.com>
 */
 class Key{
 	private $name;
 	private $value;

 	public static $instance;

 	private function __construct($name,$value){
 		$this->name  = $name;
 		$this->value = $value;
 		return $this;
 	}

 	public static function getInstance($name = null,$value = null){
 		if (!isset(self::$instance)) {
 			self::$instance = new self($name,$value);
 		}
 		return self::$instance;
 	}

 	public function setName($name){
 		$this->name = $name;
 		return $this;
 	}

 	public function getName(){
 		return $this->name;
 	}

 	public function setValue($value,$encoded = true){
 		$finalValue = $value;
 		if($encoded){
 			$finalValue = base64_encode(json_encode($value));
 		}
 		$this->value = $finalValue;
 	}

 	public function getValue($decoded = true){
 		$return = $this->value;
 		if($decoded){
 			$return = base64_decode(json_decode($this->value));
 		}
 		return $return;
 	}

 }