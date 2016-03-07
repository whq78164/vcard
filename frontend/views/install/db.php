<?php
use yii\helpers\Url;
use yii\helpers\Html;

if(!empty($error)) {
    $message= '<div class="alert alert-danger">发生错误: ' . $error . '</div>';
}
?>


    <?=$message?>
<form class="form-horizontal" method="post" role="form">

    <div class="panel panel-default">
        <div class="panel-heading">数据库选项</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库主机</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[server]" value="127.0.0.1">
                    <p>默认端口为3306，如需更改，请在主机名后加冒号。<br/>如127.0.0.1:3399或msqlrds.vcards.top:3399</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库用户</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[username]" value="root">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库密码</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[password]">
                </div>
            </div>

            <!--div class="form-group">
                <label class="col-sm-2 control-label">表前缀</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[prefix]" value="ims_">
                </div>
            </div-->

            <div class="form-group">
                <label class="col-sm-2 control-label">数据库名称</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[name]" value="vcards">
                </div>
            </div>
        </div>
    </div>

    <!--div class="panel panel-default">
        <div class="panel-heading">管理选项</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">管理员账号</label>
                <div class="col-sm-4">
                    <input class="form-control" type="username" name="user[username]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">管理员密码</label>
                <div class="col-sm-4">
                    <input class="form-control" type="password" name="user[password]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-4">
                    <input class="form-control" type="password"">
                </div>
            </div>
        </div>
    </div-->

    <input type="hidden" name="do" id="do" />
    <ul class="pager">
        <li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
        <li class="previous"><a href="javascript:;" onclick="if(check(this)){jQuery('#do').val('continue');$('form')[0].submit();}">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
    </ul>

</form>

<script>
    var lock = false;
    function check(obj) {
        if(lock) {
            return;
        }
        $('.form-control').parent().parent().removeClass('has-error');
        var error = false;
        $('.form-control').each(function(){
            if($(this).val() == '') {
                $(this).parent().parent().addClass('has-error');
                this.focus();
                error = true;
            }
        });
        /*			if(error) {
         alert('请检查未填项');
         return false;
         }
         */			if($(':password').eq(0).val() != $(':password').eq(1).val()) {
            $(':password').parent().parent().addClass('has-error');
            alert('确认密码不正确.');
            return false;
        }
        lock = true;
        $(obj).parent().addClass('disabled');
        $(obj).html('正在执行安装');
        return true;
    }
</script>
