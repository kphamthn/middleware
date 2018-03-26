<?php
	require("function.php");
	$autoloader = join(DIRECTORY_SEPARATOR,[__DIR__,'../vendor','autoload.php']);
	require $autoloader;

	use PHPOnCouch\CouchClient;
	use PHPOnCouch\Exceptions;
	
	$client = new CouchClient(DBSERVER,DBNAME);
	
	// To prevent user from accessing through browser
	if($_SERVER['REQUEST_METHOD']=="GET"){
		die("404");
	} 
	session_start();
?>