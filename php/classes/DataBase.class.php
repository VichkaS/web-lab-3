<?php

class DataBase {
	private static $db = null; // Единственный экземпляр класса, чтобы не создавать множество подключений
	private $MySQLi; // Идентификатор соединения

	public static function getDB(array $dbOptions) {
		if (self::$db == null) self::$db = new DataBase($dbOptions);
		return self::$db;
	}

	private function __construct(array $dbOptions) {
		$this->MySQLi = new mysqli(
								$dbOptions['db_host'],
								$dbOptions['db_user'],
								$dbOptions['db_pass'],
								$dbOptions['db_name']);
		if (mysqli_connect_errno()) {
			throw new Exception('Ошибка базы данных.');
		}
		
		$this->MySQLi->set_charset("utf8");
	}
	
	public static function query($q){
		return self::$db->MySQLi->query($q);
	}
	
	public static function selectRow($q) {
		$result_set = self::$db->MySQLi->query($q);
		return $result_set->fetch_assoc();
	}
	
	public static function select($q) {
		$result_set = self::$db->MySQLi->query($q);
		if (!$result_set) return false;
		return self::resultSetToArray($result_set);
	}
	 
	private static function resultSetToArray($result_set) {
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false) {
		  $array[] = $row;
		}
		return $array;
	 }
	
	public static function getMySQLiObject(){
		return self::$db->MySQLi;
	}
	
	public static function esc($str){
		return self::$db->MySQLi->real_escape_string(htmlspecialchars($str));
	}
	
	
	public function __destruct() {
		if ($this->MySQLi) $this->MySQLi->close();
	}
}
?>