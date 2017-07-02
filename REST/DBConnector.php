<?php
class DBConnector {
	private $db;
	private $statement;

	public function __construct($dbname, $user, $pass, $host, $timezone=NULL){
		try{
			$this->db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			if(!is_null($timezone)){
				$this->db->exec("SET time_zone='$timezone';");
			}
		} catch(PDOException $e) {
            echo "Fatal MySQL error<br/>";
            echo "Error Message:<br/>".$e->getMessage();
        }
	}

	public function __destruct(){
		$this->db = NULL;
	}

	private function executeQuery($sql, $val = array()){
		$this->statement = $this->db->prepare($sql);
		if(empty($val))
			return $this->statement->execute();
		else
			return $this->statement->execute($val);
	}

	private function fetchAllArray(){
		return $this->statement->fetchAll();
	}

	public function deleteQuery($table, $where){
		$sql = "DELETE FROM $table WHERE $where";
		$this->executeQuery($sql);
	}

	/**
	* $table = String
	* $field = String separated with comma (,)
	* $where = String condition
	* sample = query/books/title,description/1/
	* @return = array of query data
	*/
	public function selectQuery($table, $field, $where = "1"){
		if(strpos($field,',') !== false){
			$field = explode(',', $field);
		}
		if(is_array($field)){
			$f = "";
			foreach($field AS $k => $v){
				$f .= "`$v`,";
			}
			$f = substr($f,0,-1);
		}
		else{
			$f = $field;
		}
		$sql = "SELECT $f FROM $table WHERE $where";
		//echo $sql;
		//exit();
		$this->executeQuery($sql);
		return $this->statement->fetchAll();
	}

	public function selectSingleQuery($table, $field , $where){
		$sql = "SELECT $field FROM $table WHERE $where LIMIT 1";
		//echo $sql;
		//exit();
		$this->executeQuery($sql);
		$result = $this->statement->fetchAll();
		return $result[0]["$field"];
	}

	public function selectSingleQueryArray($table, $field , $where){
		if(is_array($field)){
			$fields = implode(",", $field);
		}
		else{
			$fields = $field;
		}
		$sql = "SELECT $fields FROM $table WHERE $where LIMIT 1";
		$this->executeQuery($sql);
		$result = $this->statement->fetchAll();
		return $result[0];
	}

	public function insertQuery($table, $array){
		$sql = "INSERT INTO $table";
		$xquery = array();
		foreach($array AS $k => $v){
			if(!empty($v)){
				$col .= "`$k`, ";
				if($v=="NOW()"){
					$val .= "NOW(), ";
				}
				else{
					$val .= ":$k, ";
					$xquery[":$k"] = "$v";
				}
			}
		}
		$col = " (".substr($col, 0, -2).") ";
		$val = "VALUES (".substr($val, 0, -2).") ";
		$sql .= $col.$val;
		if(empty($xquery)){
			return FALSE;
		}
		else{
			if($this->executeQuery($sql, $xquery)){
				return $this->db->lastInsertId();
			}
			else{
				return FALSE;
			}
		}
	}

	public function updateQuery($table, $array, $where){
	$sql = "UPDATE $table SET ";
		$xquery = array();
		foreach($array AS $k => $v){
				if($v == "NOW()"){
					$col .= "`$k` = NOW(),";
				}
				else{
					$col .= "`$k` = :$k,";
					$xquery[":$k"] = "$v";
				}
		}
		$sql .= substr($col,0,-1)." WHERE $where";
		if(empty($array)){
			return FALSE;
		}
		else{
			return $this->executeQuery($sql, $xquery);
		}
	}

	/**
	* $table = String
	* $array = array of data to be inserted to the given table. It could be $_POST val
	* @return = id as array of inserted data
	*/
	public function insertUpdateQuery($table, $array){
		$sql = "INSERT INTO $table";
		$xquery = array();
		$col = "";
		$val = "";
		foreach($array AS $k => $v){
				$col .= "`$k`, ";
				if($v == "NOW()"){
					$val .= "NOW(), ";
				}
				else{
					$val .= ":$k, ";
					if(is_array($v)){
						$xquery[":$k"] = "".implode(" | ", $v);
					}
					else{
						$xquery[":$k"] = "$v";
					}
				}
		}
		$col = " (".substr($col, 0, -2).") ";
		$val = "VALUES (".substr($val, 0, -2).") ";
		$sql .= $col.$val. "ON DUPLICATE KEY UPDATE ";
		$up = "";
		foreach($array AS $k => $v){
			if($k == "id")
				continue;
			if($v == "NOW()")
				$up .= "`$k` = NOW(),";
			else
				$up .= "`$k` = :$k,";
		}
		$sql .= substr($up,0,-1);
		if(empty($xquery)){
			return FALSE;
		}
		else{
			$this->executeQuery($sql, $xquery);
			$id = $this->db->lastInsertId();
			if(empty($id))
				return $array['id'];
			else
				return array("id"=>$id);
		}
	}

	public function getNumRows(){
		return $this->statement->rowCount();
	}

	public function getCountRows($table, $field="*", $where="1"){
		$sql="SELECT count($) FROM $table WHERE $where ";
		$this->statement = $this->db->prepare($sql);
		$this->statement->execute();
		$rows = $this->statement->fetch(PDO::FETCH_NUM);
		return $rows[0];
	}

}
