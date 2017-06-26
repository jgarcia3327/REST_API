<?php
require_once("BaseRest.php");
require_once("OnlineSchool.php");

class RestHandler extends BaseRest {

	function getAllBooks() {

		$book = new OnlineSchool();
		$rawData = $book->getAllBooks();

		$this->deliverData($rawData);
	}

	function getBook($id) {

		$book = new OnlineSchool();
		$rawData = $book->getBook($id);

		$this->deliverData($rawData);
	}

	function deliverData($rawData) {

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No list found!');
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}

	}

	public function encodeHtml($responseData) {

		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;
	}

	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;
	}

	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><list></list>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
}
?>
