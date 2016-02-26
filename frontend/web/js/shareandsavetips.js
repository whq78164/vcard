var WEIXIN = 1;
var UC = 2;
var THREESIXZERO = 3;
var SAFARI = 4;
//1 苹果端,2 安卓端,3 ipad端,4 PC端
var OTHERDEVICE = 0;
var IPHONE = 1;
var ANDROID = 2;
var IPAD = 3;
var PC = 4;
var OTHERBROW =0;
var step = 0;

var illusOnly = true;

var loaded = false;
$(function(){
	if(!loaded){
		$("#favor_Info").bind("click",function(){
			if(step == 1){
				showSaveTips();
			}else{
				$("#favor_Info").hide();
			}
		});
		
		$("#favor_Info_Other").bind("click",function(){
			$("#favor_Info_Other").hide();
		});
		 loaded = true;
	}
	
	$("#downLoadUC").bind("touchstart",function(){
		window.open("http://m.app.uc.cn/apk/index.php?f=12_0_0_0_0&app=100&system=soft&module=display_shenma&id=424546&view=default");
	})
	
	$("#downLoad360").bind("touchstart",function(){
		window.open("http://mse.360.cn/m/index.html");
	})
});

showShareTipsFirst = function(){
	var tips = GetCookie('shareAndSave');
	if(tips != 1){
		var sBorw = sourceBrow();
		if(sBorw != OTHERBROW){
			showShareTips();
			SetCookie("shareAndSave", "1");
		}
	}
}

showShareTips = function(){
	var sBorw = sourceBrow();
	var sDevice = sourceDevice();
	$("#favor_Info").removeClass().addClass("favor_info");
	$("#float_knowed").removeClass().addClass("float_knowed");
	
	switch (sBorw){
		case WEIXIN :
			weixinShare();
			break;
		case UC :
			ucShare();
			break;
		case THREESIXZERO :
			a360Share();
			break;
		case SAFARI :
			if(sDevice == IPHONE){
				safariShare();
			}
			break;
		default :
			otherShareAndSave();
			return;
			
	}
	$("#favor_Info").show();
	if(sBorw != WEIXIN){
		step = 1;
	}else{
		step = 2;
	}
}


showSaveTips = function(){
	var sBorw = sourceBrow();
	var sDevice = sourceDevice();
	$("#favor_Info").removeClass().addClass("favor_info");
	$("#float_knowed").removeClass().addClass("float_knowed");
	switch (sBorw){
			case UC :
				ucSave();
				break;
			case THREESIXZERO :
				a360Save();
				break;
			case SAFARI :
				if(sDevice == IPHONE){
					safariSave();
				}
				break;
			case WEIXIN :
				weixinShare();
				break;
			default :
				otherShareAndSave();
				return;
		}
	$("#favor_Info").show();
	step = 2;
}

showShareTipsOnly = function(){
	showShareTips();
	step = 2;
}

function sourceDevice(){
	var ua = navigator.userAgent.toLowerCase();
	if(ua.indexOf("iphone") != -1){
		return IPHONE;
	}else if(ua.indexOf("android") != -1){
		return ANDROID;
	}else if(ua.indexOf("ipad") != -1){
		return IPAD;
	}else if(ua.indexOf("windows nt") != -1){
		return PC;
	}else{
		return OTHERDEVICE;
	}
}

function sourceBrow(){
	var ua = navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i)=="micromessenger") {
		return WEIXIN;
	}else if (ua.indexOf("ucbrowser") != -1){
		return UC;
	}else if(ua.indexOf("360 aphone browser") != -1){
		return THREESIXZERO;
	}else if(ua.indexOf("safari") != -1){
		var sourceType = sourceDevice();
		if(sourceType == 1){
			return SAFARI;
		}
		return OTHERBROW;
	}else{
		return OTHERBROW;
	}
}

weixinShare = function(){
	$("#favor_Info").addClass("favor_weixin_share");
	$("#float_knowed").addClass("float_knowed_bottom");
}

ucShare = function(){
	$("#favor_Info").addClass("favor_uc_share");
	$("#float_knowed").addClass("float_knowed_top");
}

a360Share = function(){
	$("#favor_Info").addClass("favor_A360_share");
	$("#float_knowed").addClass("float_knowed_bottom");
}

safariShare = function(){
	$("#favor_Info").addClass("favor_safari_share");
	$("#float_knowed").addClass("float_knowed_top");
}

ucSave = function(){
	$("#favor_Info").addClass("favor_uc_save");
	$("#float_knowed").addClass("float_knowed_top");
}

a360Save = function(){
	$("#favor_Info").addClass("favor_360_save");
	$("#float_knowed").addClass("float_knowed_top");
}

safariSave = function(){
	$("#favor_Info").addClass("favor_safari_save");
	$("#float_knowed").addClass("float_knowed_top");
}

otherShareAndSave = function(){
	$("#favor_Info").hide();
	$("#favor_Info_Other").show();
}
