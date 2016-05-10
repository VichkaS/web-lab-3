<?php

class ChatLine {
	
	protected $login_name = '', $text = '';
	
	public function __construct($login_name, $text_msg) {
		$this->login = $login_name;
		$this->text = $text_msg;
	}
	
	public function save(){
		DataBase::query("
			INSERT INTO `messages` (`login`,`message`)
			VALUES (
				'".DataBase::esc($this->login)."',
				'".DataBase::esc($this->text)."'
		)");
		
		return DataBase::getMySQLiObject();
	}
}
?>