$(function(){
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
	function SetUserData(name, pass) {
		
		$.ajax({
			type: "POST",
			url: "http://localhost/calender/signUp.php",
			dataType:'json',
			data: {
				'name':name,
				'password':pass,
			},
			success:function(data){
				if (data.status == 1) {
					MoveMain();
					return;
				}
				if (data.status == 2) {
					WriteWarning(data.message);
					return;
				}
			},
			error:function(data){
				alert("通信に失敗");
			}
		});
	}

	// ログイン
	function Login(name, pass) {
		$.ajax({
			type: "POST",
			url: "http://localhost/calender/login.php",
			dataType: 'json',
			data: {
				'name': name,
				'password': pass,
			},
			success: function (data) {
				if (data.status == 1) {
					MoveMain();
					return;
				}
				if (data.status == 2) {
					WriteWarning(data.message);
					return;
				}
			},
		});
	}

	function WriteWarning(word) {
		$('.warning').text(word).css('color','rgba(255, 51, 51, 1)');
	}

	function Cryotico() {
		
	}

	function GetRSAKey() {
		// RSA鍵作成
		var passPhrase = "yamAdaMatUmototaNaKA";
		var bits = 1024;
		var RSAkey = cryptico.generateRSAKey(passPhrase, bits);
		return RSAkey;
	}

	function GetPublicKey(RSAKey) {
		// 公開鍵作成
		var publicKeyString = Cryotico.publicKeyString(RSAkey);
		return publicKeyString;
	}
});