$(function(){
	//默认通知
    noticeDefault = function(content){
    	$('#j-toast-default').children().html(content);
    	$('#j-toast-default').toggleClass('active');
        setTimeout(function(){$('#j-toast-default').removeClass('active');},3000);
    }
    //带图标通知
    noticeIcon = function(content){
    	$('#j-toast-icon').children().html('<i class="iconfont"></i>' + content);
    	$('#j-toast-icon').toggleClass('active');
        setTimeout(function(){$('#j-toast-icon').removeClass('active');},3000);
    }
    
    //带图标通知
    noticeIcontime = function(content,time){
    	$('#j-toast-icon').children().html('<i class="iconfont"></i>' + content);
    	$('#j-toast-icon').toggleClass('active');
        setTimeout(function(){$('#j-toast-icon').removeClass('active');},time);
    }
    
    whiteNoticeDefault = function(content){
    	$('[data-action="j-while-content"]').html(content);
    	$('#popup-while-defalut').toggleClass('active');
    }
    
    //失败关闭
    failClose = function(tip,content){
    	$('[data-action="j-fail-close-tip"]').html(tip);
    	$('[data-action="j-fail-close-content"]').html(content);
    	$('#j-fail-close').toggleClass('active');
    }
    
    //关闭键
    $("[data-action='popUpClose']").on("click",function(){
    	popClose();
    });
    
    //对话默认
    confirmDefault = function (content){
    	$('[data-action="j-confirm-default-content"]').html(content);
    	$('[data-action="j-confirm-default"]').toggleClass('active');
    }
    
    //关闭
    popClose = function(){
    	$('.ui-popup-mask,.ui-popup-iosbox').removeClass('active');
    }
    
    //ui-pageswitch 页面切换
	$('body').on('click','[data-action="close"]',function(){
		removeActive();
		event.preventDefault();
	});
	
	$("[data-action='pageswitch']").on('click',function(){
		$("[data-page='pa'],[data-page='pb'],[data-action='close']").toggleClass('active');
		$("[data-page='pa'],[data-page='pb']").addClass('m-anim');
		event.preventDefault();
	});
	
	//开关
	$('body').on('click','[data-action="switch"]',function(){
		if($(this).attr('data-value') == 0){
		}else{
			$(this).toggleClass('active');
		}
		event.preventDefault();
	});
	
	removeActive = function (){
		$("[data-page='pa'],[data-page='pb'],[data-action='close'],[data-page='pa_b'],[data-page='pb_b']").removeClass('active');
		$(this).removeClass('active');
	}
	
	//带标题的对话框
	confirmTip = function(tip,content){
		$('[data-action="j-confirm-tip-tip"]').html(tip);
		$('[data-action="j-confirm-tip-content"]').html(content);
		$('#j-confirm-tip').toggleClass('active');
	}
	
	//带重置按钮设置的对话框
	confirmFailReset = function(tip,content,reset){
		$('[data-action="j-confirm-fail-operation-tip"]').html(tip);
		$('[data-action="j-confirm-fail-operation-content"]').html(content);
		$('[data-action="j-confirm-fail-operation-reset"]').html(reset);
		$('#j-confirm-fail-operation').toggleClass('active');
	}
	
});