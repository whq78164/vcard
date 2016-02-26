// JavaScript Document
	var i = 0;
	var j = 0;
	var count = 0;
	var MM = 0;
	var SS = 0;
	var MS = 0;
	var totle = (MM+1)*600;
	console.info( totle);
	var d = 180*(MM+1);
	var MM = "0" + MM;
	var gameTime = 10;
	var complete = 0;
	var settimev = 0;
	var flaset = 0;
	var subk = 0;
	var sjs = parseInt(Math.random()*30+70);
	console.info(sjs);
	//count down
	var showTime = function(){
		
	    totle = totle - 1;
		 if (document.readyState == "complete" && complete == 1) {
		 	if(subk == 0){
				clearInterval(s);
				s = setInterval("showTime()",5);
				subk = 1;
			}else{
				if(totle < 0){
					clearInterval(s);
					$(".loadUp").addClass("slideUp");
			        $(".loadDown").addClass("slideDown");
			        $(".game_time").hide(1000);
			        $(".m-content").show(2000);
					$(".pie2").css("-o-transform", "rotate(" + d + "deg)");
			        $(".pie2").css("-moz-transform", "rotate(" + d + "deg)");
			        $(".pie2").css("-webkit-transform", "rotate(" + d + "deg)");
					setTimeout(function(){
						$(".loadbox").hide();
					},1000);
				}
			}
		 }else{
			if (totle < 20) {
				clearInterval(s);
				s = setInterval("showTime()",2000);
			}
		 	if(complete == 1){
				if(settimev == 0){
				 	clearInterval(s);
					settimev = 1;
				}
				if(flaset == 0){
					s = setInterval("showTime()",32*13);
					flaset =1;
				}
			}
		 }
		 
	    if (totle == sjs) { //(600-60)/600=90% 
			console.info( totle);
	      /*  document.onreadystatechange=subSomething;//当页面加载状态改变的时候执行这个方法。
	        function subSomething()
	        {*/
			complete = 1;
	    } else {
	        if (totle > 0 && MS > 0) {
	            MS = MS - 1;
	            if (MS < 10) {
	                MS = "0" + MS
	            };
	        };
	        if (MS == 0 && SS > 0) {
	            MS = 10;
	            SS = SS + 1;
	            if (SS >99) {
	                SS = "100";
	            };
	        };
	        if (SS == 0 && MM > 0) {
	            SS = 60;
	            MM = MM - 1;
	            if (MM < 10) {
	                MM = "0" + MM
	            };
	        };
	    };
		i = i + 360/((gameTime)*10);  //旋转的角度  90s 为 0.4  60s为0.6
		count = count + 1;
		if(count <= (gameTime/2*10)){  // 一半的角度  90s 为 450
			$(".pie1").css("-o-transform","rotate(" + i + "deg)");
			$(".pie1").css("-moz-transform","rotate(" + i + "deg)");
			$(".pie1").css("-webkit-transform","rotate(" + i + "deg)");
		}else{
			$(".pie2").css("backgroundColor", "#d13c36");
			$(".pie2").css("-o-transform","rotate(" + i + "deg)");
			$(".pie2").css("-moz-transform","rotate(" + i + "deg)");
			$(".pie2").css("-webkit-transform","rotate(" + i + "deg)");
		}
	    $(".time").html((SS-2)*10 + "%");
	};
	var countDown = function() {
	    //80*80px 时间进度条
	    i = 0;
	    j = 0;
	    count = 0;
	    MM = 0;
	    SS = gameTime;
	    SS=1;
	    MS = 0;
	    totle = (MM + 1) * gameTime * 10;
	    d = 180 * (MM + 1);
	    MM = "0" + MM;
	    s = setInterval("showTime()",10);
	};
	countDown();
	setTimeout(function(){
			clearInterval(s);
			$(".loadUp").addClass("slideUp");
	        $(".loadDown").addClass("slideDown");
	        $(".game_time").hide(1000);
	        $(".m-content").show(2000);
			$(".pie2").css("-o-transform", "rotate(" + d + "deg)");
	        $(".pie2").css("-moz-transform", "rotate(" + d + "deg)");
	        $(".pie2").css("-webkit-transform", "rotate(" + d + "deg)");
			setTimeout(function(){
						$(".loadbox").hide();
					},1000);
			},10000);

