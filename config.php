<?
$slash = DIRECTORY_SEPARATOR;
spl_autoload_register(function($nomeClass){
	global $slash;
	
	$dirClass = "class";
	$filename = $dirClass.$slash.$nomeClass.".php";
	
	if(file_exists($filename)){ require_once($filename); }
	
});


?>