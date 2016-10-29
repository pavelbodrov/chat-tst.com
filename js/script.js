function get_msg() //получаем данные сервера
{
	$.getJSON('php/load_msg.php', function(data) {
		var m_obj;
		$("#show-list").empty(); //чистим
		for (i = 0;i<data.length;i++)
		{
			m_obj=data[i];
			m_obj=m_obj.trim();
			m_obj=JSON.parse(m_obj);
			$("#show-list").append('<li><span class="msg_login">'+ m_obj.login + "</span>" + '<span class="msg_time">' + m_obj.time +' </span><br>'+ '<span class="msg_comment">' + m_obj.comment +'</span></li>');
		}
	});
};
				
function send_msg(send_json) //отправляем сообщения на сервер в формате JSON
{
	$.ajax({
		url: "php/server.php",
		cache: false,
		type: "POST",
		data: 'jsonData=' + send_json,
		success: function (data) {
			$("textarea#comment").val("");
		},
		error: function() {
			alert('Error!');
		}
	});
};

function aggregate_msg(login) //главная функция отправки и загрузки сообщений
{
	$(document).ready(function () {
		$('#send-comment-button').click(function() {	
			var date = new Date();							
			var t = date.getHours() + ":" + date.getMinutes();
			var id= date.getFullYear() + "-" +date.getMonth() + "-" +date.getDate() + "-" +date.getHours() + "-" + date.getMinutes() + "-" + date.getSeconds();
			var comment = document.getElementById("comment").value;
			var msg_obj = { //объект сообщения
				"id":id,
				"login":login,
				"time":t,
				"comment":comment
				};
			var send_json = JSON.stringify(msg_obj); //преобразуем в формат JSON
			if (comment.length!=0)
			{
				send_msg(send_json); //отправляем JSON сообщения на сервер							
				get_msg(); //получаем JSON сообщения с сервера										
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