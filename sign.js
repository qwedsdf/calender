$(function(){
	var calenderUrl = "http://localhost/calender/main.html";

	// ユーザー登録
	$("#sign-up").click(function(){
		var name = $('input[name="userName"]').val();
		var pass = $('input[name="password"]').val();
		SetUserData(name,pass);
	});

	// 移動
	$(".move-main").click(function(){
		// MoveMain();		
	});

	// ログイン
	$("#login").click(function(){
		var name = $('input[name="userName"]').val();
		var pass = $('input[name="password"]').val();
		Login(name,pass).done(function(result){
			if(result!=null){
				MoveMain();
			}
		});
	});

	function MoveMain(){
		var res = encodeURI(calenderUrl);
		window.location.href = res;
	}

	function SetUserData(name,pass){
		$.ajax({
			type: "POST",
			url: "http://localhost/calender/signUp.php",
			cache: false,
			data: {
				'name':name,
				'password':pass,
			},
		});
	}

	function Login(name,pass){
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