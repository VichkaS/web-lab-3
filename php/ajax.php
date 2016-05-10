<?php

	$dbOptions = array(
		'db_host' => 'localhost',
		'db_user' => '',
		'db_pass' => '',
		'db_name' => 'web_lab3_chat'
	);
	
	error_reporting(E_ALL ^ E_NOTICE);

	require "classes/DataBase.class.php";
	require "classes/Chat.class.php";
	require "classes/ChatLine.class.php";
	require "classes/ChatUser.class.php";

	session_name('chat_lab3');
	session_start();

	try{
		$db = DataBase::getDB($dbOptions);

		$response = array();
		
		switch($_GET['action']){
			
			case 'login':
				$response = Chat::login($_POST['login'],$_POST['password']);
			break;
			
			case 'submitChat':
				$response = Chat::submitChat($_POST['mess_to_send']);
			break;
			
			case 'getChats':
				$response = Chat::getChats($_GET['lastID']);
			break;
			
			case 'getUsers':
				$response = Chat::getUsers();
			break;
			
			case 'getSess':
				$response = Chat::sessExists();
			break;
			
			default:
				throw new Exception('Wrong action');
		}
		echo json_encode($response);
	}

	catch(Exception $e){
		die(json_encode(array('error' => $e->getMessage())));
	}

?>