$(function(){
	$("#sign-up").click(function(){
		var name = $('input[name="userName"]').val();
		var pass = $('input[name="password"]').val();

		setUserData(name,pass);
	});

	function setUserData(name,pass){
		$.ajax({
			type: "POST",
			url: "http://localhost/calender/login.php",
			cache: false,
			data: {
				'name':name,
				'password':pass,
			},
		});
	}
});