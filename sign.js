$(function(){
	var calenderUrl = "http://localhost/calender/main.html";

	// ユーザー登録
	$("#sign-up").click(function(){
		var name = $('input[name="userName"]').val();
		var pass = $('input[name="password"]').val();
		setUserData(name,pass);
	});

	// 移動
	$(".move-main").click(function(){
		var res = encodeURI(calenderUrl);
		window.location.href = res;
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