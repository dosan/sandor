<?php 

class MainModel
{

	/**
	* Every model needs a database connection, passed to the model
	* @param object $db A PDO database connection
	*/
	public $db;
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}
	
	function selectAll($table) {
		$sql = 'SELECT * FROM `'.$table.'`';
		$this->db->query($sql);
		return $query;
	}
	
	function select($id) {
		$query = 'SELECT * FROM `'.$this->_table.'` WHERE `id` = \''.$id.'\'';
		return $query;    
	}
	public function querySqlWithTryCatch($sql){
		try {
			$query = $this->db->prepare($sql);
			$query->execute();
		} catch (PDOException $e) {
			exit(CONNECTION_FAILED);
		}
		return $query;
	}
	public function getArrayResult($query){
		if(! $query) return false;
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}
	public function found_rows(){
		$query = $this->db->query('SELECT FOUND_ROWS()');
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}