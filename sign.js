$(function(){
	var calenderUrl = "http://localhost/calender/main.html";

	// ユーザー登録
	$("#sign-up").click(function(){
		var name = $('input[name="userName"]').val();
		var pass = $('input[name="password"]').val();
		SetUserData(name,pass);
	});

	// ログイン
	$("#login").click(function () {
		var name = $('input[name="userName"]').val();
		var pass = $('input[name="password"]').val();
		Login(name,pass);
	});

	// カレンダーに移動
	function MoveMain(){
		var res = encodeURI(calenderUrl);
		window.location.href = res;
	}

	// ユーザー登録
	function SetUserData(name,pass){
		$.ajax({
			type: "POST",
			url: "http://localhost/calender/signUp.php",
			dataType:'json',
			data: {
				'name':name,
				'password':pass,
			},
			success:function(data){
				alert("成功");
				if(data.status == 1){
					MoveMain();
				}
			},
			error:function(data){
				alert("失敗");
				if(data.status == 1){
					MoveMain();
				}
			}
		});
	}

	// ログイン
	function Login(name,pass){
		$.ajax({
			type: "POST",
			url: "http://localhost/calender/login.php",
			dataType:'json',
			data: {
				'name':name,
				'password':pass,
			},
			success:function(data){
				if(data.status == 1){
					MoveMain();
				}
			},
		});
	}
});