<?php
set_include_path(get_include_path().PATH_SEPARATOR.'lib/'.PATH_SEPARATOR.'tests/ApcHandler/');
spl_autoload_register(function($className){
	require_once str_replace(array("\\","_"),"/",$className).'.php';
});