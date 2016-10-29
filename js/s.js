function check_login(log)
				{
					//var str="user";
					$.ajax({
						url: "php/check_login.php",
						cache: false,
						type: "POST",
						data: 'log=' + log,
						success: function (response) {
							//$("textarea#comment").val("");
							alert(response)
						},
						error: function() {
							alert('Error!');
						}
					});
				}