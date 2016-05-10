<?php
class ChatUser {
	
	private $login = '';
	
	public function __construct($login_name) {
		$this->login = $login_name;
	}
	
	public function getUser(){
		return DataBase::selectRow("
			SELECT * FROM `users` WHERE `login`=
				'".DataBase::esc($this->login)."' ");		
	}
}
?>