function get_msg() //получаем данные сервера
{
	var get_data = $.getJSON('php/load_msg.php', function(data) {
		var m_obj;
		$("#show-list").empty(); //чистим
		if (data!=null)
		{
			for (i = 0;i<data.length;i++)
			{
				//alert(data[i]["comment"]);
				//m_obj=data[i];
				//m_obj=m_obj.trim();
				//m_obj=JSON.parse(m_obj);
				$("#show-list").append('<li id="msgList"><span class="msg_login">'+ data[i]["login"] + "</span>" + '<span class="msg_time">' + data[i]["time"] +' </span><br>'+ '<span class="msg_comment">' + data[i]["comment"] +'</span><span class="msg_id" style="opacity:0">' + data[i]["id"] + '</span></li>');
			}
		}
		//alert("get bitch");
	});
	get_data.promise().done(function(){
		var objDiv = document.getElementById("show-msg");
			objDiv.scrollTop = objDiv.scrollHeight;
			//alert(objDiv.scrollHeight);			
	});
};
				
function send_msg(send_json) //отправляем сообщения на сервер в формате JSON
{
	$.ajax({
		url: "php/server.php",
		cache: false,
		type: "POST",
		data: 'jsonMsg=' + send_json,
		success: function (data) {
			$("textarea#comment").val("");
			//alert(data);
			/*
			$.ajax({
				url: "php/listener.php",
				cache: false,
				type: "POST",
				data: 'signal=' + "refresh",
				success: function (data) {
					//$("textarea#comment").val("");
					//alert(data);
				},
				error: function() {
					alert('Error!');
				}
			});
			*/
		},
		error: function() {
			alert('Error!');
		}
	});
	
};
function changeChecker(id) //takes last message' ID from the cliend page and checks whether new messages have been added. If there are new messages on the server it calls get_msg() function
{
	
	$.ajax({
		url: "php/listener.php",
		cache: false,
		type: "POST",
		data: 'lastMsg=' + id,
		success: function (data) {
			if (data=="refresh")
			{
				get_msg();
			}
		},
		error: function() {
			alert('Error!');
		}
	});
}
function getLastMsg() //get last(current) message ID from the page and pass it as a parameter to function changeCecker
{
	var lastMessageId = parseInt($('.msg_id').last().text());
	changeChecker(lastMessageId);
		
	//});
}

function aggregate_msg(login) //главная функция отправки и загрузки сообщений
{
	$(document).ready(function () {
		$('#send-comment-button').click(function() {	
			var date = new Date();							
			var t = date.getHours() + ":" + date.getMinutes();
			var comment = document.getElementById("comment").value;
			var msg_obj = { //объект сообщения
				"login":login,
				"time":t,
				"comment":comment
				};
			var send_json = JSON.stringify(msg_obj); //преобразуем в формат JSON
			if (comment.length!=0)
			{
				send_msg(send_json); //отправляем JSON сообщения на сервер							
				//get_msg(); //получаем JSON сообщения с сервера										
			}
			else alert("Don't try send empty messages, buddy!");
		});
	});
};

function inform_user(message){ //функция вывода подсказок в форме
	$(document).ready(function(){
					//$("#inform_user").append("<br>Wrong password! Try again!");
				$("#inform_user").append(message);
				});
};

function showFormHint() //функция вывода подсказки при наведении на форму
{
	var minHeight = $("#helper").css('min-height');
	$(document).ready(function(){
		$("#star-form").mouseover(function(){
			//$("#helper").css("display", "block");
			$("#helper").css("min-height",0).slideDown( "slow", function() {$("#helper").css("min-height",minHeight)});
		});
		$("#star-form").mouseleave(function(){
			$( "#helper" ).css("min-height",0).slideUp("slow", function() {$("#helper").css("min-height",minHeight)});
		});
	});
};
function check_login(log)
{
	$("#indicator").text("");
	$.ajax({
		url: "php/check_login.php",
		cache: false,
		type: "POST",
		data: 'log=' + log,
		success: function (response) {
			if (response=="busy")
			{
				$("#indicator").text("Busy");
				$("#reg_button").attr("disabled", "disabled");
									
			}
			else
			{
				$("#indicator").text("Free");
				$("#reg_button").removeAttr("disabled");
			}						
		},
		error: function() {
			alert('Error!');
		}
	});
}