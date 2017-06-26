<?php
require_once("RestHandler.php");

$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		// to handle REST Url /rest/list/
		$mobileRestHandler = new RestHandler();
		$mobileRestHandler->getAllBooks();
		break;

	case "single":
		// to handle REST Url /rest/show/<id>/
		$mobileRestHandler = new RestHandler();
		$mobileRestHandler->getBook($_GET["id"]);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
