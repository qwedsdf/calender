$(function(){
	var dummyUserId = 102;
	var selectDay = 0;
	var $year = $('#js-year');
	var $month = $('#js-month');
	var $tbody=$('#js-calender-body');

	var today=new Date();
	var currentYear = today.getFullYear();
	var currentMonth = today.getMonth();

	setCalenderHeader(currentYear,currentMonth);
	createCalenderBody(currentYear,currentMonth);

	// 日にちのボタン押下時
	$(".btn").click(function(){
		selectDay = $(this).attr("id");
		$(".modal-wrapper").fadeIn();

		// モーダルに現在の内容を表示
		var content=getUserAction(selectDay);
		$("#content-text").val(content);
	});

	// モーダルを閉じる
	$(".close-modal").click(function (){
		$(".modal-wrapper").fadeOut();
	});

	// ツイート
	$("#tweet-btn").click(function() {
		var value = $("#content-text").val() + '\n\n';
		var url = "https://twitter.com/intent/tweet?hashtags=今日の積み上げ&text="+value;
		var res = encodeURI(url);
		window.location.href = res;
	});

	//記録を保存する
	$(".save").click(function (){
		// DBに保存、表示更新
		// 入力値取得
		var value = $("#content-text").val();
		var month = currentMonth + 1;

		setUserAction(selectDay,value);

		$.ajax({
			type: "POST",
			url: "http://localhost/calender/setdata.php",
			cache: false,
			data: {
				'date':selectDay,
				'content':value,
				'userId':dummyUserId,
			},
		});
	});

	function getUserAction(date){
		return $('#'+date).find('.day-content').text();
	}

	function getuserActionApi(date){
		return $.ajax({
			type: "POST",
			url: "http://localhost/calender/getdata.php",
			async:false,
			data: {
				'date':date,
				'userId':dummyUserId,
			},

		});

		
		var result = "aiueo0";

		

		return result;
	}

	function setUserAction(date,content){
		$('#'+date).find('.day-content').html(content.replace(/\n/g,"<br>\n"));
	}

	// カレンダー作成
	function createCalenderBody(year,month){
		var startDate = new Date(year,month,1);
		var endDate = new Date(year,month+1,0);
		var startDay = startDate.getDay();
		var endDay = endDate.getDate();
		var textSkip = true;
		var textDate = 1;
		var tableBody = '';
		for(var row=0; row<6; row++){
			var tr = '<tr>';

			for(var col=0; col<7; col++){

				if(row === 0 && startDay === col){
					textSkip = false;
				}
				if(textDate > endDay){
					textSkip = true;
				}
				var textTd = textSkip ? '' : textDate++;
				var dateId = zeroPadding(year,4) + '-' + zeroPadding((month + 1),2)  + '-' + zeroPadding((textDate-1),2);
				var text = "";
				getuserActionApi(dateId).done(function (result){
					text = result.replace(/\n/g,"<br>\n");
				})
				var frontSpanTag = (textTd === '') ? '<span><h3>':'<span id = ' + dateId + ' class="btn"><h3>';
				var backSpanTag = (textTd === '') ? '</h3></span>':'</h3><div class="day-content">'+text+'</div></span>';
				var td = '<td>' + frontSpanTag + textTd + backSpanTag;
				tr += td;
			}
			tr += '</tr>';
			tableBody += tr;
		}
		$tbody.html(tableBody);
	}

	function zeroPadding(num,length){
		return ('0000000000000000'+num).slice(-length);
	}

	function setCalenderHeader(year,month){
		$year.text(year);
		$month.text(month + 1);
	}
});