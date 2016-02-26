path = "http://mp.soqi.cn";
wap = "http://m.soqi.cn";
twoCodepath = "http://two.soqi.cn";
var pic = "http://pic.soqi.cn";
var vd = "http://vd.soqi.cn";
var domain = ".soqi.cn";
var resourcePath="http://mp.soqi.cn";
var portraitPath="http://7xitth.com2.z0.glb.qiniucdn.com";
var background="http://7xixdl.com2.z0.glb.qiniucdn.com";
var singlepage="http\://7xk5tc.com2.z0.glb.qiniucdn.com";
var mpqrcode="http://7xjoax.com2.z0.glb.qiniucdn.com";
var contentqr="http://7xk39h.com2.z0.glb.qiniucdn.com";
var qqqr = "http://7xkt0q.com2.z0.glb.qiniucdn.com"
var weixinqr = "http://7xkt0p.com2.z0.glb.qiniucdn.com"
var weiboqr = "http://7xkt0r.com2.z0.glb.qiniucdn.com"
$(document).ready(function(){
	//初始化返回按钮
	if($('#tips').length != 0){
		setTimeout(hideTip,2000);
	}
	if(getOs()== "MSIE"){
		window.location.href = "/imgDeal/downbrowser.jsp";
	}
});


closeMe = function (){
        $('#_alert_bg').remove();
}

hideTip = function(){
        $("#tips").slideUp(500);
};
//添加时间函数
function SetCookie(name, value){
        var Days = 30;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/;domain="+domain;
}

//获取时间函数
function GetCookie(name){
    var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if (arr != null) return unescape(arr[2]); return null;

}

//删除时间函数
function DelCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = GetCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString() + ";path=/;domain="+domain;
}


//添加产品
addPro = function (pid,pnum){
        this.pid = pid;
        this.pnum = pnum;
}

//修改产品值
editPro = function (pid,pnum){
        this.pid = pid;
        this.pnum = pnum;
}

//遮罩层
alert_bg = function (str){
        if($('#_alert_bg').length <= 0){
        var html = "";
        html += "<div id='_alert_bg'><div id='_alert_content'>" + str + "</div></div>";
        $('body').append(html);
        setTimeout(function(){
                $('#_alert_bg').remove();
        },1000);
        }
}

//遮罩层
alert_can_close = function (str){
        var html = "";
        html += "<div id='_alert_bg'><div id='_alert_content'><img src='../../images/icon-close.png' style='float:right;width:20px;' onclick='closeMe();'>" + str + "</div></div>";
        $('body').append(html);
}

login_bg = function (url){
        $('body').append("<div id='_alert_bg'></div>");
        var html = "<iframe id='theIframe' src='" + vd + "/jsp/vip/minishop/userlogin.jsp?path=" + url +"' style='visibility: visible; display: block; height: 270px;";
        html += " -webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1;'></iframe>";
        $('body').append(html);
}

animatePic = function( obj ,angle){
        obj.animate({  borderSpacing: angle }, {
           step: function(now,fx) {
                $(this).css('-webkit-transform','rotate('+now+'deg)');
                $(this).css('-moz-transform','rotate('+now+'deg)');
                $(this).css('-ms-transform','rotate('+now+'deg)');
                $(this).css('-o-transform','rotate('+now+'deg)');
                $(this).css('transform','rotate('+now+'deg)');
            },
           duration:'slow' },'linear');
}

$(function(){
	//展开更多标签
	$('#j-m-moremenu').bind({
		'click':function(){
			$('.m-menubox').toggleClass('active');
			if(!($('.m-menuboxbg').length > 0)){
				$('body').append("<div class='m-menuboxbg'></div>");
			};
			$('.m-menuboxbg').toggleClass('active');
			//获取消息
			$.ajax({
				url : path + "/mpCompany/findMsg.xhtml",
				type : "POST",
	                	dataType:"json",
				async : true,
				cache : false,
				success : function(msg){
					$('.badge').html(msg.msg);
					$('#j-sys-msg-tip').html(msg.msg);
				}
			});
		}
	});
	$('body').on({
			'touchmove':function() {
				$('.m-menuboxbg').remove();
				$(".m-menubox").removeClass('active');
			},
			'touchstart':function() {
				$('.m-menuboxbg').remove();
				$(".m-menubox").removeClass('active');
			},
			'touchstart':function() {
				$('.m-menuboxbg').remove();
				$(".m-menubox").removeClass('active');
			}
	},'.m-menuboxbg');
});

getOs = function(){//判断浏览器
   if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){  
		return "Firefox";  
   }  
   if(isSafari=navigator.userAgent.indexOf("Safari")>0) {  
		return "Safari";  
   }   
   if(isCamino=navigator.userAgent.indexOf("Camino")>0){  
		return "Camino";  
   }  
   if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){  
		return "Gecko";  
   }  
   if(navigator.userAgent.indexOf("MSIE")>0 || navigator.userAgent.indexOf("rv")>0) { 
	  // alert('MSIE'); 
		return "MSIE";  
   } 
}
