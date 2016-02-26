/**
 * User: suolan
 * Date: 13-7-29
 * Time: 下午11:31
 */

(function (window, $) {
    var $page;
    $(function () {
        var wbp = window.WBPage;
        wbp.PageData = {};
        var lid = wbp.Loader.append();

        wbp.Property_CID = $.getUrlParam('cid');
        wbp.Property_DID = $.getUrlParam('did');
        if (window.localStorage && window.localStorage.getItem(''))

            wbp.Property_WXID = $.getUrlParam('wxid');

        wbp.hide();
        $(window).bind('rendercomplete', function () {
            wbp.show();
        });

        //1.获取当前页面类型
        var struc_type = window.WBPage.getWBData('type');
        var noweb = !!(window.WBPage.getWBData('noweb') === 'true');//页面是否使用微网站dom结构

        //如果页面不是用微网站dom结构，则直接加载指定得处理器
        if (noweb) {
            WBPage.Loader.remove(lid);

            //加载对应的类型处理器
            if (struc_type) {
                $.getScript(wbp.PATH_TYPE_PROCESSOR + struc_type + '.js').fail(function () {
                    $(window).trigger('rendercomplete');
                    $('html').addClass('RENDERCOMPLETE');
                });
            }
            else {
                $(window).trigger('rendercomplete');
                $('html').addClass('RENDERCOMPLETE');
            }

            return;
        }


        //2.添加页面通用部件基础DOM
        var $body = $('body');
        var $page = $('.weiba-page', $body);
        var $content = $('.weiba-content', $page);

        if (struc_type != 'home') {//非首页添加导航条
            if(typeof(ft) != 'undefined' && ft == 1)
            {
                var html_navbar = '<div class="weiba-navbar tpl-navbar" style="top:20px">';
            }else{
                var html_navbar = '<div class="weiba-navbar tpl-navbar">';
            }
            html_navbar += '<a class="weiba-navbar-item tpl-navbar-item back"><div class="icon"></div><div class="seg"></div></a>';
            html_navbar += '<a class="weiba-navbar-item tpl-navbar-item home"><div class="icon"></div><div class="seg"></div></a>';
            //html_navbar += '<a class="weiba-navbar-item tpl-navbar-item easycall"><div class="icon"></div><div class="seg"></div></a>';
            html_navbar += '<a class="weiba-navbar-item tpl-navbar-item quick"><div class="icon"></div><div class="seg"></div></a>';
            html_navbar += '</div>';
            $page.prepend(html_navbar);
        }


        var html_pagebottom = '<div class="weiba-footer">';
        html_pagebottom += '<div class="weiba-copyright tpl-copyright">&copy;公司名称</div>';
        html_pagebottom += '<a class="weiba-support tpl-support" href="">技术支持</a>';
        html_pagebottom += '</div>';

        $page.append(html_pagebottom);

        var html_quickpanel = '<div class="weiba-quickpanel">';
        html_quickpanel += '<div class="weiba-list tpl-quickpanel">';
        html_quickpanel += '<a class="weiba-list-item tpl-catelist-item" href="#">';
        html_quickpanel += '<div class="weiba-list-item-line">';
        html_quickpanel += '<div class="weiba-list-item-title tpl-cate-title">快捷链接</div>';
        html_quickpanel += '</div>';
        html_quickpanel += '<div class="weiba-list-item-icon icon-arrow-r"></div>';
        html_quickpanel += '</a>';
        html_quickpanel += '</div>';
        html_quickpanel += '</div>';
        $body.append(html_quickpanel);

        /*创建小轮子快捷方式*/
        function easycallround(ea) {
            var html_easycall = '';
            html_easycall += '<div class="weiba-easycall round" style="z-index: 9999999;">';

            html_easycall += '<div class="weiba-easycall-show">';


            for(var i in ea["assists"] ){

                var rs = ea["assists"][i];

                if (rs.type == 0) {
                    html_easycall += '<a class="weiba-easycall-item " href="tel:' + $.translateTel(rs.content) + '">';
                }
                else {
                    html_easycall += '<a class="weiba-easycall-item " href="' + rs.content + '">';
                }

                if (ea['position'] == 0) {
                    html_easycall += '<span class="icon icon-left" style="background-image:url(' + rs['icon'] + ')"></span>';


                } else if (ea['position'] == 2) {
                    html_easycall += '<span class="icon icon-right" style="background-image:url(' + rs['icon'] + ')"></span>';

                }

                html_easycall += '<span class="text">' + rs['title'] + '</span>';
                html_easycall += '</a>';

            }


            html_easycall += '</div>';
            html_easycall += '<a class="weiba-easycall-but">';
            html_easycall += '</a></div>';

            $body.append(html_easycall);
            $body.addClass('weiba-easycallround');

            $('.weiba-easycall-item').each(function(index){
                var dif_margin = 5, max_margin = ea['assists'].length * dif_margin, dif_rotate = 2, max_rotate = ea['assists'].length * dif_rotate;

                var transform_l = '-webkit-transform:rotate(' + (max_rotate - (index + 1) * dif_rotate) + 'deg);transform:rotate(' + (max_rotate - (index + 1) * dif_rotate) + 'deg);-moz-transform:rotate(' + (max_rotate - (index + 1) * dif_rotate) + 'deg);';
                var transform_r = '-webkit-transform:rotate(-' + (max_rotate - (index + 1) * dif_rotate) + 'deg);transform:rotate(-' + (max_rotate - (index + 1) * dif_rotate) + 'deg);-moz-transform:rotate(-' + (max_rotate - (index + 1) * dif_rotate) + 'deg);'
                if (ea['position'] == 0) {
                    $(this).attr('style', 'margin-left: ' + (max_margin - (index + 1) * dif_margin) + 'px;' + transform_l);

                } else if (ea['position'] == 2) {
                    $(this).attr('style', 'margin-right: ' + (max_margin - (index + 1) * dif_margin) + 'px;' + transform_r);

                }

            })
            if (ea['position'] == 0) {
                $('.weiba-easycall').addClass('left');
                $('.weiba-easycall-item').addClass(' padding-left');
                $('.weiba-easycall-but').addClass('left');
            } else if (ea['position'] == 2) {
                $('.weiba-easycall').addClass('right');
                $('.weiba-easycall-item').addClass(' padding-right');
                $('.weiba-easycall-but').addClass('right');

            }
            $(window).on('rendercomplete',function(){
                $('.weiba-easycall').addClass('show');
            })

        }

        /*创建底部HOME条快捷栏*/
        function EasyPanelHome(data) {
            if (!data || !data['assists'] || !data['assists'].length) {
                return;
            }
            var assists = data['assists'], group_length = assists.length, html = '';
            for (var i = 0; i <= group_length; i++) {
                html += '<div class="page ' + ((group_length ==2) ? ' double' : '') + '">';
                for (var j = 0; j < 4; j++) {
                    var item = assists[i * 4 + j];
                    if (item) {
                        var href = $.trim(item['content']);
                        if (item['type'] == 0) {
                            href = 'tel:' + href;
                        }

                        html += '<a class="easycall-item" href="' + href + '">';
                        html += '<img class="icon" src="' + item['icon'] + '">';
                        html += '<div class="title">' + item['title'] + '</div>';
                        html += '</a>';
                    }
                }
                html += '</div>';
            }
            html = ('<div class="weiba-easycall home-panel"><div class="panel-box">' + html + '</div></div>');
            var $epanel =$(html).appendTo('body').swipe({
                startSlide: 0,
                speed: 500,
                auto: 0,
                continuous: true,
                disableScroll: (group_length > 0 ? false : true),
                stopPropagation: false,
                callback: function (index, elm) {
                    //selectedIndex(index);
                },
                transitionEnd: function (index, elm) {
                }
            }).on('click', '.panel-ctr.left', function () {
                $epanel.data('swipe').prev();
            })
                .on('click', '.panel-ctr.right', function () {
                    $epanel.data('swipe').next();
                });
            $body.addClass('weiba-easyhomepanel');
            $epanel.append('<a href="/"><div class="home-box"></div></a>');



//            if (group_length > 0) {//大于两页出来左右箭头
//                $epanel.append('<div class="panel-ctr left"></div><div class="panel-ctr right"></div>');
//            }
        }
        /*创建底部条快捷栏*/
        function createEasyPanel(data) {
            if (!data || !data['assists'] || !data['assists'].length) {
                return;
            }
            var assists = data['assists'], group_length = Math.ceil((assists.length / 4)) - 1, html = '';
            for (var i = 0; i <= group_length; i++) {
                html += '<div class="page ' + (group_length > 0 ? ' padding' : '') + '">'
                for (var j = 0; j < 4; j++) {
                    var item = assists[i * 4 + j];
                    if (item) {
                        var href = $.trim(item['content']);
                        if (item['type'] == 0) {
                            href = 'tel:' + href;
                        }

                        html += '<a class="easycall-item" href="' + href + '">';
                        html += '<img class="icon" src="' + item['icon'] + '">';
                        html += '<div class="title">' + item['title'] + '</div>';
                        html += '</a>';
                    }
                }
                html += '</div>';
            }
            html = ('<div class="weiba-easycall panel"><div class="panel-box">' + html + '</div></div>');
            var $epanel = $(html).appendTo('body').swipe({
                startSlide: 0,
                speed: 500,
                auto: 0,
                continuous: true,
                disableScroll: (group_length > 0 ? false : true),
                stopPropagation: false,
                callback: function (index, elm) {
                    //selectedIndex(index);
                },
                transitionEnd: function (index, elm) {
                }
            }).on('click', '.panel-ctr.left', function () {
                $epanel.data('swipe').prev();
            })
                .on('click', '.panel-ctr.right', function () {
                    $epanel.data('swipe').next();
                });
            $body.addClass('weiba-easycallpanel');

            if (group_length > 0) {//大于两页出来左右箭头
                $epanel.append('<div class="panel-ctr left"></div><div class="panel-ctr right"></div>');
            }
        }

        //创建底部自定义菜单
        function CustomNav(data){
            console.log('自定义菜单数据：',data);
            var str = '';
            if( data.menu && data.menu.length ){
                str = '<div class="weiba-easycall custom-nav">';
                str += '<ul class="clearfix">';
                for(var i = 0; i < data.menu.length; i++){
                    str += '<li>';
                    str += '<span class="p-menu">';
                    if( data.menu[i].sub_menu && data.menu[i].sub_menu.length ){
                        str +='<a class="has-sub-menu"><u></u>'+data.menu[i].name+'</a></span>';
                        str += '<div class="sub-menu"><i></i>';
                        for(var j = 0; j < data.menu[i].sub_menu.length; j++){
                            str +=  '<a '+( j == 0 ? 'style="border:none;"' : '')+' href="'+data.menu[i].sub_menu[j].link+'">'+data.menu[i].sub_menu[j].name+'</a>';
                        }
                        str += '</div>';
                    }else{
                        str += '<a href="'+data.menu[i].link+'">'+data.menu[i].name+'</a></span>';
                    }
                    str += '</li>';
                }
                str += '</ul>';
                str += '</div>';
            }
            $('body').append(str).css({'padding-bottom':'40px'});
            var li_len = $('.weiba-easycall.custom-nav li').length;
            $('.weiba-easycall.custom-nav ul').addClass('list-'+li_len);
            $('.weiba-easycall.custom-nav .p-menu').on('click',function(e){
                e.stopPropagation();
                if( $(this).next().hasClass('sub-menu') ){
                    $(this).next().toggle();
                    $(this).parent().siblings().find('.sub-menu').hide();
                }
            })
            // $(document).on('click',function(){
            //     $('.weiba-easycall.custom-nav .sub-menu').hide();
            // })
            $(window).on('touchmove',function(){
                $('.weiba-easycall.custom-nav .sub-menu').hide();
            })
        }
        //创建底部自定菜单(HOME键 带图标)
        function setBottomNavIcon(data){

            var html = '<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)"><nav><ul id="top_menu" class="top_menu">';
            var html_home = '<li class="home">'+
                '<a href="'+data.url+'">'+
                '<img src="'+data.pic+'" width="66" height="66" />'+
                '</a>'+
                '</li>';

            if( data.menu && data.menu.length ){

                for(var i = 0; i < data.menu.length; i++){
                    html += '<li class="top_bar_nav">';
                    if( data.menu[i].sub_menu && data.menu[i].sub_menu.length ){//如果有2级菜单
                        html+= '<a href="javascript:;">'+
                        '<img src="'+data.menu[i].pic+'">'+
                        '<label>'+data.menu[i].name+'</label>'+
                        '</a>'+
                        '<ul id="menu_list'+i+'" class="menu_font hidden">';

                        for(var j = 0; j < data.menu[i].sub_menu.length; j++){
                            html +=  '<li><a href="'+data.menu[i].sub_menu[j].link+'"><img src="'+data.menu[i].sub_menu[j].pic+'"><label>'+data.menu[i].sub_menu[j].name+'</label></a></li>';
                        }

                        html+= '</ul>';

                    }else{//如果没有2级菜单
                        html += '<a href="'+data.menu[i].link+'"><img src="'+data.menu[i].pic+'"><label>'+data.menu[i].name+'</label></a>';
                    }

                    html += '</li>';
                }
            }
            switch(data.menu.length) {
                case 0:
                    html+='<li class="top_bar_nav"></li><li class="top_bar_nav"></li><li class="top_bar_nav"></li><li class="top_bar_nav"></li>';
                    break;
                case 1:
                    html+='<li class="top_bar_nav"></li><li class="top_bar_nav"></li><li class="top_bar_nav"></li>';
                    break;
                case 2:
                    html+='<li class="top_bar_nav"></li><li class="top_bar_nav"></li>';
                    break;
                case 3:
                    html+='<li class="top_bar_nav"></li>';
                    break;
            }

            html += '</ul></nav></div>';

            $('body').append(html).css({'padding-bottom':'40px'});
            $("#top_menu .top_bar_nav").eq(1).after(html_home);

            $("#top_menu .top_bar_nav").on('click',function(e){
                var thiscss = $(this).find('.menu_font').hasClass('hidden');
                console.log(thiscss);
                if(thiscss){
                    $("#top_menu .top_bar_nav").find('.menu_font').addClass('hidden');
                    $(this).find('.menu_font').removeClass('hidden')
                }else{
                    $("#top_menu .top_bar_nav").find('.menu_font').addClass('hidden');
                }
            });

            $(window).on('touchmove',function(){
                $('.weiba-easycall.custom-nav .sub-menu').hide();
            })
        }


        //3.读取和渲染页面通用部件数据
        var data_req = {
            'info': {
                url: wbp.PATH_DATA_INFO,
                success : function(result){
                    $(window).on('rendercomplete',function(){
                        //result.baidu_app_id = '3772352';
                        var flg_weixin = /(MicroMessenger)/i.test(navigator.userAgent);
                        if( result.baidu_app_id && !flg_weixin ){
                            (function(){
                                var script = document.createElement("script");
                                script.type = "text/javascript";
                                script.charset = "utf-8";
                                var date = new Date();
                                var version = date.getFullYear()+""+date.getMonth()+""+date.getDate()+""+date.getHours();
                                script.src = "http://m.baidu.com/static/search/siteapp/lego/seed.js?t="+version;
                                script.setAttribute("data-appid",result.baidu_app_id);
                                //测试
                                script.setAttribute("data-test",true);
                                document.head.appendChild(script);
                            })();
                        }
                        if( result.code ){
                            $(result.code).appendTo('head');
                        }
                        if("logo" in result){
                            if(result.logo != ""){
                                $("body").attr("weiba-icon",result.logo);
                            }
                        }

                    })
                }
            },

            'easycall': {
                url: wbp.PATH_DATA_EASYCALL,
                success: function (result) {
                    if (result) {
                        var ea = result;
                        if (ea['display'] > 0 && ((ea['display'] == 1 && wbp.getWBData('type') == 'home') || ea['display'] == 2) || (ea['display'] == 3 && wbp.getWBData('type') != 'home')) {
                            if (ea['type'] == 1) {
                                createEasyPanel(result);
                            } else if(ea['type'] == 0){
                                easycallround(result);
                            }else if(ea['type'] == 2){
                                EasyPanelHome(result);
                            }else if(ea['type'] == 3 ){
                                CustomNav(result);
                            }else if(ea['type'] == 4){
                                setBottomNavIcon(result);
                            }
                        }
                    }
                }
            },

            'effect': {
                url: wbp.PATH_EFFECT,
                success: function (result) {
                    if (result) {
                        $.each(result, function (key, item) {
                            if ($.isPlainObject(item)) {
                                if (item['enabled'] && $.isArray(item['scope'])) {
                                    if (item['scope'].indexOf(wbp.getWBData('type')) > -1) {
                                        if( key == 'Door' ){
                                            var doors = window.sessionStorage.getItem('door');
                                            if( doors != '1' || !doors ){
                                                window.sessionStorage.setItem('door','1');
                                                $.getScript(wbp.PATH_EFFECT_PLUG_FILE[key]);
                                            }
                                        }else{
                                            $.getScript(wbp.PATH_EFFECT_PLUG_FILE[key]);
                                        }
                                    }
                                }
                            }
                        });
                    }
                }
            },

            'share' : {
                url : wbp.PATH_EFFECT + '/share',
                success : function(result){
                    if( result && result.length ){
                        if( result.indexOf(wbp.getWBData('type')) > -1 ){
                            var str =   '<div class="weiba-frame-share" style="margin-bottom:20px;">'+
                                '<div class="weiba-button-share friend">发送给好友</div>'+
                                '<div class="weiba-button-share quan">分享到朋友圈</div>'+
                                '</div>';
                            if( !$('.weiba-frame-share').size() ){
                                $('.weiba-footer').before(str);
                            }
                        }
                    }
                }
            },

            'footer': {
                url: wbp.PATH_DATA_FOOTER
            },

            'user':{
                url:wbp.PATH_USERCENTER,
                data:{
                    wxid:window.localStorage.getItem('WXID')
                }

            },

            'catelist': {
                url: wbp.PATH_DATA_CATELIST,
                data : {
                    wxid : (window.localStorage && window.localStorage.getItem('WXID'))?window.localStorage.getItem('WXID'):undefined
                }
            }

        };

        var directive = {
            '.tpl-copyright': {
                '.': function (arg) {
                    var da = new Date(),
                        year = da.getFullYear();
                    var ctx = arg.context;
                    if (ctx && ctx['info']) {
                        if (ctx['info']['web_name']) {
                            return '&copy;'+year+' ' + ctx['info']['web_name'];
                        } else {
                            return '&copy;'+year+' ' + ctx['info']['company'];
                        }

                    }
                }
            },
            '.tpl-support': {
                '.': '技术支持:#{footer.support.title}',
                '.@href': 'footer.support.href',
                '.@style+': function (arg) {
                    var context = arg.context;
                    if (!context || !context['footer'] || !context['footer']['support'] || !context['footer']['support']['title']) {
                        return ' ;display:none;'
                    }
                    else {
                        return ' ;display:block;';
                    }
                }
            }


        };

        if (struc_type != 'home') {//非首页加载频道列表用于显示快捷列表
            /*
            $.extend(data_req, {
                'catelist': {
                    url: wbp.PATH_DATA_CATELIST
                }
            });
            */

            $.extend(directive, {
                '.tpl-navbar-item.home': {
                    '.@href': 'info.url'
                },
                '.tpl-quickpanel': {
                    '.tpl-catelist-item': {
                        'cate<-catelist': {
                            '.@href': 'cate.url',
                            '.tpl-cate-title': 'cate.cate_name'
                        }
                    }
                }
            });
        }

        var lid_normal_data = wbp.Loader.append();

        //normal数据处理方法
        var fn_init_normal_data = function(data){
            //初始化页面信息
            var status = wbp.info_init(data['info']);

            if (status != 0) {//微网站状态不正常，跳出
                return false;
            }
            wbp.tpl_render(data, directive);

            wbp.widget_init('navbar');
            wbp.widget_init('quickpanel');
            wbp.widget_init('easycall');
            console.log('normal', data);

            //4.加载对应的类型处理器
            if (struc_type) {
                $.getScript(wbp.PATH_TYPE_PROCESSOR + struc_type + '.js').fail(function () {
                    $(window).trigger('rendercomplete');
                    $('html').addClass('RENDERCOMPLETE');
                });
            } else {
                $(window).trigger('rendercomplete');
                $('html').addClass('RENDERCOMPLETE');
            }
        };

        //获取normal数据缓存(如果超过3天，则自动失效)
        var fn_get_normal_cache = function(){
            //var max_diff = 259200000;//缓存3天
            var max_diff = 3600000;//缓存1小时
            var create_time = window.sessionStorage.getItem('data_cache_normal_createtime');
            if(create_time){
                var cur_time=new Date().getTime();
                if(cur_time-create_time<max_diff){
                    var str_data = window.sessionStorage.getItem('data_cache_normal');
                    if(str_data){
                        return JSON.parse(str_data);
                    }
                }
            }
            return false;
        };

        //保存缓存数据
        var fn_save_normal_cache = function(data){
            var cur_time=new Date().getTime();
            window.sessionStorage.setItem('data_cache_normal_createtime',cur_time);
            window.sessionStorage.setItem('data_cache_normal',JSON.stringify(data));
        };

        //缓存normal数据
        var normal_data_cache = fn_get_normal_cache();
        if(normal_data_cache){
            $.extend(wbp.PageData, normal_data_cache);

            $.each(normal_data_cache, function (key, item) {
                if (data_req[key] && typeof data_req[key].success === 'function') {
                    data_req[key].success.call(this, item);
                }
            });

            fn_init_normal_data(normal_data_cache);

            wbp.Loader.remove(lid_normal_data);

        }else{
            $.getMultiJSON(data_req, function (data, e) {
                $.extend(wbp.PageData, data);
                fn_save_normal_cache(data);
                fn_init_normal_data(data);
                wbp.Loader.remove(lid_normal_data);
            });
        }

        WBPage.Loader.remove(lid);

    });
})(window, jQuery);


(function (window, $) {

    /**
     * 模板类型构造器声明和兑现
     * @param type_name 模板类型名
     * @param widgets 该类型需要加载的部件列表
     * @param data_reqs 该类型需要请求的数据
     * @param directive_default 该类型默认的模板映射
     */
    window.WBPage.TplTypeDeclare = function (type_name, widgets, fn_page_init, data_reqs, directive/*默认的*/) {
        var wbp = window.WBPage;
        var lid = wbp.Loader.append();

        var struc_type = wbp.getWBData('type');

        //1.判断页面类型是否匹配
        if (struc_type !== type_name) {
            page_complete();
            window.alert('不能正确获得页面类型！\n页面类型:' + struc_type + '\n处理器类型:' + type_name);
            return false;
        }

        //2.判断页面是否已经存在映射设置，如果不存在则使用默认映射文件
        if (window.WBDirective) {
            $.extend(directive, window.WBDirective);
        }

        //3.判断页面是否已经存在数据源请求设置，如果不存在则使用模板类默认数据源请求
        if (window.WBDataReqs) {
            $.extend(data_reqs, window.WBDataReqs);
        }

        //4.加载数据
        var count = 0;
        if ($.isPlainObject(data_reqs)) {
            $.each(data_reqs, function () {
                count++;
            });
        }

        if (count > 0) {
            $.getMultiJSON(data_reqs, function (data, e) {
                console.log('custom', data);

                //记录扩展页面数据
                $.extend(wbp.PageData, data);
                page_complete();

            });
        }
        else {
            page_complete();
        }

        /**
         * 执行页面渲染
         */
        function page_complete() {
            //渲染模板
            wbp.tpl_render(wbp.PageData, directive);

            //页面初始化
            if ($.isFunction(fn_page_init)) {
                try {
                    fn_page_init.call(this, wbp.PageData);
                }
                catch (err) {
                    console.error('fn_page_init', err.message);
                }
            }

            //初始化标准部件
            if ($.isArray(widgets)) {
                $.each(widgets, function (index, value) {
                    wbp.widget_init(value);
                });
            }
            $(window).trigger('rendercomplete');
            $('html').addClass('RENDERCOMPLETE');
            wbp.Loader.remove(lid);

        }
    };
})(window, jQuery);

$(window).on('rendercomplete',function(){
    if( WBPage && WBPage.PageData && WBPage.PageData.info && WBPage.PageData.info.country ){
        $('body').append('<input id="MobileCountry" type="hidden" value="'+WBPage.PageData.info.country+'" />');
    }
})