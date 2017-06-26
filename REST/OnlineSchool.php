<?php
/*
A domain Class to demonstrate RESTful web services
*/
Class OnlineSchool {

	private $books = array(
		1 => 'Books on Apple iPhone 6S',
		2 => 'Books on Samsung Galaxy S6',
		3 => 'Books on Apple iPhone 6S Plus',
		4 => 'Books on LG G4',
		5 => 'Books on Samsung Galaxy S6 edge',
		6 => 'Books on OnePlus 2');

	/*
		you should hookup the DAO here
	*/
	public function getAllBooks(){
		return $this->books;
	}

	public function getBook($id){

		$book = array($id => ($this->books[$id]) ? $this->books[$id] : $this->books[1]);
		return $book;
	}
}
?>
