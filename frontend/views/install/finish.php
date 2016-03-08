<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>



<div class="col-xs-3">
    <div class="progress" title="安装进度">
        <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;">
            <?=$progress?>%
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            安装步骤
        </div>
        <ul class="list-group">
            <a href="javascript:;" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-copyright-mark"></span>
                &nbsp; 许可协议
            </a>
            <a href="javascript:;" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-eye-open"></span>
                &nbsp; 环境监测
            </a>
            <a href="javascript:;" class="list-group-item list-group-item-success">
                <span class="glyphicon glyphicon-cog"></span>
                &nbsp; 参数配置
            </a>
            <a href="javascript:;" class="list-group-item list-group-item-info">
                <span class="glyphicon glyphicon-ok"></span>
                &nbsp; 成功
            </a>
        </ul>
    </div>
</div>
<div class="col-xs-9">


<div class="page-header"><h3>安装完成</h3></div>
<div class="alert alert-success">
    <p id="install">

    </p>



    <br><br><br><br>
    <p>

		<span>
<a target="_blank" class="pull-right btn btn-success" href="<?=Url::to(['/site/login'])?>">访问系统后台</a>
        </span>

		<!--span>
		<a target="_blank" class="btn btn-success" href="./frontend/web/index.php">访问网站首页</a>
		</span-->

    </p>
</div>

<div class="alert alert-danger">
    <h1>注意！该内容只显示一遍。</h1>
    <br>
    <p>
        初始系统管理员登录名：admin
        <br/>初始密码：adminadmin
        <br/>请尽快修改默认设置或添加新系统管理员！！！
    </p>

</div>


<!--div class="form-group">
    <h5><strong>微擎应用商城</strong></h5>
    <span class="help-block">应用商城特意为您推荐了一批优秀模块、主题，赶紧来安装几个吧！</span>
    <table class="table table-bordered">
        <tbody>
            {$modules}
            {$themes}
        </tbody>
    </table>
</div>

<div class="alert alert-warning">
    我们强烈建议您立即注册云服务，享受“在线更新”等云服务。
    <a target="_blank" class="btn btn-success" href="./web/index.php?c=cloud&a=profile">马上去注册</a>
    <a target="_blank" class="btn btn-success" href="http://v2.addons.we7.cc" target="_blank">访问应用商城首页</a>
</div-->

<script Charset="UTF-8" type="text/javascript">

    $(document).ready(function(){

        var url="<?=Url::to(['/install/install'],true)?>";
        //    var data={
        //      FWuid: FWuid
        //   };

        $.ajax({
            type: 'GET',
            url: url ,
            //        data: data ,
            success: function(data,status){
                document.getElementById('install').innerHTML = data;//+status;
            }
            //   dataType: html
        });




    });

</script>


    </div>