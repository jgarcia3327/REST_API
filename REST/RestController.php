<?php
require_once("RestHandler.php");

$method = $_SERVER["REQUEST_METHOD"];

### Remote DB Request
$table = "";
if (isset($_GET["table"])) $table = $_GET["table"];
$field = "";
if (isset($_GET["field"])) $field = $_GET["field"];
$where = "";
if (isset($_GET["where"])) $where = $_GET["where"];

/*
controls the RESTful services
URL mapping
*/

switch($method) {
	case "GET":
	$query = new RestHandler();
	$query->selectQuery($table, $field, $where);
	break;
	case "PUT":
	case "POST":
	$query = new RestHandler();
	$query->insertQuery($table, $_POST);
	break;
	case "DELETE":
}
?>
