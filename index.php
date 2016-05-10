<html>
	<title>Чат (WebLab3)</title>
	<head>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<meta content="charset=utf8" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	</head>
 
	<body>
		<header id="info">
			<div id="error_message"></div>
		</header>
		<div class="content">
			<form id="loginForm" method="post" action="">
					Login: <input type="text" name="login" id="idlogin">
					Password: <input type="password" name="password" id="idpassword">
					<input type="submit" value="Вход" id="dtnLogin">
			</form>
			<table id="chat">
				<tr>
					<td>
						<div id="messages"></div>
					</td>
				</tr>
				<tr>
					<td>
						<form id="submitForm" method="post" action="">
							<input type="text" name="mess_to_send" id="mess_to_send">
							<input type="submit" value="Отправить" id="btn_send_msg">
						</form>
					</td>
				</tr>
			</table>
            <div id="user">
				<p class="user_info">Пользователи чата:</p>
				<div id="user_name"></div>
            </div>
		</div> 
		<script src="js/script.js"></script>
	</body>
</html>