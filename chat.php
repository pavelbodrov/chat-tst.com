<?php
require "php/auth.php";
require "authClass.php";
$auth = new AuthClass();
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/script.js"></script>

	</head>
	<body>
		<div id="menu">
			<a href="index.php">Home</a>
			<a href="contact.php">Join Us</a>
			<a href="chat.php">Chat</a>
		</div>
		<a id="sign-out" href="chat.php?do=logout">Sign Out</a>

		<div id="chat">
			<div id="show-msg">
				<ul id="show-list" style="list-style-type:none">
				</ul>
			</div>
			<form id="send-form" method="POST">
				<textarea placeholder="Type some text here" id="comment" name="c"></textarea>
				<p id="greet">Welcome to StarChat, <span><?php echo $_SESSION['login'];?></span></p>
				<button id="send-comment-button" type="button" >Send</button>
			</form>
		</div>
			<span id="star_span">Star</span>
			<span id="chat_span">Chat</span>
		
		<script>
			var login = "<?php echo $auth->getLogin() ?>";				
			setInterval(function(){ get_msg() }, 200); //обновляем сообщения каждую секунду
			//get_msg();
			aggregate_msg(login);
			//var objDiv = document.getElementById("show-msg");
			//objDiv.scrollTop = objDiv.scrollHeight;
			//alert(objDiv.scrollHeight);
		</script>
		
	</body>
</html>