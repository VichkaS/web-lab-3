$(document).ready(function(){
	
	chat.init();
	
});

var chat = {
	
	lastID 		: 0,
	
	init : function(){
		
		var working = false;
				
		$('#loginForm').submit(function(){
			
			if (working) return false;
			working = true;
			
			$.post('php/ajax.php?action=login', $(this).serialize(), function(data){
				working = false;
				
				if (data.error){
					chat.displayError(data.error);
				}
				else {
					chat.displayUser(data.login);
					$("#idlogin").val('');
					$("#idpassword").val('');
				};
			},'json');

			return false;
		});
		
		$('#submitForm').submit(function(){
			
			var text = $('#mess_to_send').val();
			
			if (text.length == 0) {
				return false;
			}
			
			if (working) { 
				return false 
			};
			working = true;		
			
			$.post('php/ajax.php?action=submitChat', $(this).serialize(), function(data){
				if (data.error) {
					chat.displayError(data.error);
				}
				else {
					chat.displayUser(data.login)};
				working = false;
			}, 'json');

			$("#mess_to_send").val('');
			return false;
		});
		
		chat.getSess();
		chat.getUsers();
		
		(function getChatsTimeoutFunction(){
			chat.getChats(getChatsTimeoutFunction);
		})();
	},
	
	addChatLine : function(params) {
		$("#messages").append("<b><font color='orange'>"+params['login']+"</b>:&nbsp;</font></b>"+params['message']+"<br>");
        $("#messages").scrollTop(2000);
	},
	
	getChats : function(callback) {
		$.get('php/ajax.php?action=getChats', {lastID: chat.lastID}, function(data){
			
			for (var i = 0; i < data.chats.length; i++) {
				chat.addChatLine(data.chats[i]);
			}
			
			if (data.chats.length) {
				chat.lastID = data.chats[i-1].id;
			}

			setTimeout(callback, 1000);
		}, 'json');
	},
	
	//проверить сессию
	getSess : function() {
		$.get('php/ajax.php?action=getSess', function(data) {
			if (data.error){
				chat.displayError(data.error);
			}
			else {
				chat.displayUser(data.login)
			};
		}, 'json');
	},
	
	// Запрос списка всех пользователей.
	getUsers : function(){
		$.get('php/ajax.php?action=getUsers', function(data){
			
			var users = [];
			
			for (var i=0; i < data.users.length; i++) {
				if (data.users[i]) {
					$("#user_name").append("<b><font color='orange'>"+data.users[i].login+"</font></b><br>");
				}
			}
		}, 'json');
	},
	
	displayError : function(msg){
		$("#error_message").empty();
		$("#error_message").append("<div>"+msg+"</div>");
	},
	
	displayUser : function(name){
		$("#error_message").empty();
		$("#error_message").append("<div>"+"Ваш логин: "+name+"</div>");
	}
};