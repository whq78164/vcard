$(window).on("rendercomplete",function(){new businesscard()});function businesscard(){this.init()}businesscard.prototype={init:function(){this.change_top_height();this.custom_list();this.show_mark()},change_top_height:function(){setTimeout(function(){var a=$(".card-top").width();$(".card-top").height(a/3*2)},1)},custom_list:function(){var b=window.WBPage;if(b){var a=b.PageData.businesscard;var g=b.PageData.footer;var e=b.PageData.info;if(a){$("title").html(a.name+"的名片");$(".top-company-text").html(a.company_name);$(".top-company-href").attr("href","/");if(g.support["title"]){$(".jishuzhichi").html(g.support["title"]);$(".jishuzhichi").attr("href",g.support["href"])}else{$(".bottom-box").hide()}$(".weiba-name").html(e.web_name);var d=a.config;for(var c in a.config){var d=a.config[c];switch(d.name){case"m_department":$(".tpl-bc-depart").html(d.value);break;case"m_port":$(".tpl-bc-post").html(d.value);break;case"m_port":$(".tpl-bc-post").html(d.value);break;case"m_sign":$(".tpl-bc-sign").html(d.value);break;default:var f={};f.text=d.text+":";f.val=d.value;f.name=d.name;this.custom_view(f);break}}}}},custom_view:function(d){var k=window.WBPage;var e=this;var c="http://api.map.baidu.com/marker";var j="";j+='<li class="card-content-item">';j+='<span class="card-content-item-tips '+d.name+'"></span>';if(d.name.indexOf("m_custom")>-1){j+='<a class="blud-font"><span class="card-content-item-tips ">'+d.text+"</span>"}switch(d.name){case"m_mobile":j+=' <a href="tel:'+d.val+'" class="blud-font">'+d.val+"</a>";break;case"m_tele":j+=' <a href="tel:'+d.val+'" class="blud-font">'+d.val+"</a>";break;case"m_email":j+=' <a href="mailto:'+d.val+'" class="blud-font">'+d.val+"</a>";break;case"m_weixin":j+=' <a class="blud-font">'+d.val+"</a>";break;case"m_weibo":j+=' <a href="'+d.val+'" class="blud-font">'+d.val+"</a>";break;case"m_QQ":j+=' <a class="blud-font">'+d.val+"</a>";break;case"m_address":if(k){var h=k.PageData;var f=h.businesscard["company_lat"],g=h.businesscard["company_lng"],b=h.businesscard["company_name"],i=h.businesscard["company_name"];if(f&&g){var a=c;a+="?location="+f+","+g+"&title="+b+"&name="+b+"&content="+i+"&output=html&src=weiba|weiweb";j+=' <a href="'+a+'" class="blud-font">'+d.val+"</a></div>"}else{j+=d.val+"</div>"}}break;default:j+=d.val;if(d.name.indexOf("m_custom")>-1){j+="</div>"}break}j+="</li>";$(".page-bc-con-view").append(j);if(d.name=="m_weixin"){}setTimeout(function(){$(".card-content-item ").each(function(){var l=parseInt($(this).height());if(l>42){$(this).attr("class","card-content-item-over")}})},1)},show_mark:function(){$(".tpl-to-mark").on("tap",function(){var a=window.WBPage;if(a){var d=a.PageData.footer;var c=a.PageData.info;var b="";b+='<div class="bc-mark-page">';b+='<div class="bc-mark">';b+='<div class="bc-mark-img"><img src="'+a.PageData.businesscard["qrcode"]+'" class=""></div>';b+='<div class="bc-mark-tips">用微信“扫一扫”上面的二维码图案，直接将名片信息保存至您的手机通讯录。</div>';b+="</div>";$.OpenPopUp("名片二维码",b,"#282828",function(){$("#popUp").css({position:"absolute"});$(window).scrollTop(0);$(".tpl-back").on("tap",function(){$.ClosePopUp()})})}})},show_weixin:function(a){$(".m_weixin").parent().on("tap",function(){var b=window.WBPage;if(b){var f=b.PageData.footer;var e=b.PageData.info;var d="http://open.weixin.qq.com/qr/code/?username="+a;var c="";c+='<div class="bc-mark-page">';c+='<div class="bc-mark">';c+='<div class="bc-mark-img"><img src="'+d+'" class=""></div>';c+='<div class="bc-mark-tips">用微信“扫一扫”上面的二维码图案，添加为微信好友。</div>';c+="</div>";$.OpenPopUp("微信二维码",c,"#282828",function(){$("#popUp").css({position:"absolute"});$(window).scrollTop(0);$(".tpl-back").on("tap",function(){$.ClosePopUp()})})}})}};