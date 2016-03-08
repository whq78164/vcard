<?php
use yii\helpers\Url;
use yii\helpers\Html;


if(empty($ret['continue'])) {
    $continue = '<li class="previous disabled"><a href="javascript:;">请先解决环境问题后继续</a></li>';
} else {
    $continue = '<li class="previous"><a href="javascript:;" onclick="$(\'#do\').val(\'continue\');$(\'form\')[0].submit();">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>';
}

function replaceArr($arr){
    $arr = isset($arr) ? $arr : 'success';
    return $arr;
}
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
            <a href="javascript:;" class="list-group-item list-group-item-info">
                <span class="glyphicon glyphicon-eye-open"></span>
                &nbsp; 环境监测
            </a>
            <a href="javascript:;" class="list-group-item ">
                <span class="glyphicon glyphicon-cog"></span>
                &nbsp; 参数配置
            </a>
            <a href="javascript:;" class="list-group-item ">
                <span class="glyphicon glyphicon-ok"></span>
                &nbsp; 成功
            </a>
        </ul>
    </div>
</div>
<div class="col-xs-9">

<div class="panel panel-default">
    <div class="panel-heading">服务器信息</div>
    <table class="table table-striped">
        <tr>
            <th style="width:150px;">参数</th>
            <th>值</th>
            <th></th>
        </tr>
        <tr class="<?=replaceArr($ret['server']['os']['class'])?>">
            <td>服务器操作系统</td>
            <td><?=replaceArr($ret['server']['os']['value'])?></td>
            <td><?=replaceArr($ret['server']['os']['remark'])?></td>
        </tr>
        <tr class="<?//=replaceArr($ret['server']['sapi']['class'])?>">
            <td>Web服务器环境</td>
            <td><?=replaceArr($ret['server']['sapi']['value'])?></td>
            <td><?=replaceArr($ret['server']['sapi']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['server']['php']['class'])?>">
            <td>PHP版本</td>
            <td><?=replaceArr($ret['server']['php']['value'])?></td>
            <td><?=replaceArr($ret['server']['php']['remark'])?></td>
        </tr>
        <!--tr class="<?=replaceArr($ret['server']['dir']['class'])?>">
            <td>程序安装目录</td>
            <td><?=replaceArr($ret['server']['dir']['value'])?></td>
            <td><?=replaceArr($ret['server']['dir']['remark'])?></td>
        </tr-->
        <tr class="<?=replaceArr($ret['server']['disk']['class'])?>">
            <td>磁盘空间</td>
            <td><?=replaceArr($ret['server']['disk']['value'])?></td>
            <td><?=replaceArr($ret['server']['disk']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['server']['upload']['class'])?>">
            <td>上传限制</td>
            <td><?=replaceArr($ret['server']['upload']['value'])?></td>
            <td><?=replaceArr($ret['server']['upload']['remark'])?></td>
        </tr>
    </table>
</div>

<div class="alert alert-info">PHP环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。</div>
<div class="panel panel-default">
    <div class="panel-heading">PHP环境要求</div>
    <table class="table table-striped">
        <tr>
            <th style="width:150px;">选项</th>
            <th style="width:180px;">要求</th>
            <th style="width:50px;">状态</th>
            <th>说明及帮助</th>
        </tr>
        <tr class="<?=replaceArr($ret['php']['version']['class'])?>">
            <td>PHP版本</td>
            <td>5.4或者5.4以上</td>
            <td><?=replaceArr($ret['php']['version']['value'])?></td>
            <td><?=replaceArr($ret['php']['version']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['pdo']['class'])?>">
            <td>MySQL</td>
            <td>支持(建议支持PDO)</td>
            <td><?=replaceArr($ret['php']['mysql']['value'])?></td>
            <td rowspan="2"><?=replaceArr($ret['php']['pdo']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['pdo']['class'])?>">
            <td>PDO_MYSQL</td>
            <td>支持(强烈建议支持)</td>
            <td><?=replaceArr($ret['php']['pdo']['value'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['curl']['class'])?>">
            <td>allow_url_fopen</td>
            <td>支持(建议支持cURL)</td>
            <td><?=replaceArr($ret['php']['fopen']['value'])?></td>
            <td rowspan="2"><?=replaceArr($ret['php']['curl']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['curl']['class'])?>">
            <td>cURL</td>
            <td>支持(强烈建议支持)</td>
            <td><?=replaceArr($ret['php']['curl']['value'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['ssl']['class'])?>">
            <td>openSSL</td>
            <td>支持</td>
            <td><?=replaceArr($ret['php']['ssl']['value'])?></td>
            <td><?=replaceArr($ret['php']['ssl']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['gd']['class'])?>">
            <td>GD2</td>
            <td>支持</td>
            <td><?=replaceArr($ret['php']['gd']['value'])?></td>
            <td><?=replaceArr($ret['php']['gd']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['dom']['class'])?>">
            <td>DOM</td>
            <td>支持</td>
            <td><?=replaceArr($ret['php']['dom']['value'])?></td>
            <td><?=replaceArr($ret['php']['dom']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['php']['session']['class'])?>">
            <td>session.auto_start</td>
            <td>关闭</td>
            <td><?=replaceArr($ret['php']['session']['value'])?></td>
            <td><?=replaceArr($ret['php']['session']['remark'])?></td>
        </tr>
    </table>
</div>

<div class="alert alert-info">系统要求唯卡微名片整个安装目录必须可写, 才能使用所有功能。</div>
<div class="panel panel-default">
    <div class="panel-heading">目录权限监测</div>
    <table class="table table-striped">
        <tr>
            <th style="width:150px;">目录</th>
            <th style="width:180px;">要求</th>
            <th style="width:50px;">状态</th>
            <th>说明及帮助</th>
        </tr>
        <tr class="<?=replaceArr($ret['write']['root']['class'])?>">
            <td>/</td>
            <td>整目录可写</td>
            <td><?=replaceArr($ret['write']['root']['value'])?></td>
            <td><?=replaceArr($ret['write']['root']['remark'])?></td>
        </tr>
        <tr class="<?=replaceArr($ret['write']['data']['class'])?>">
            <td>/</td>
            <td>data目录可写</td>
            <td><?=replaceArr($ret['write']['data']['value'])?></td>
            <td><?=replaceArr($ret['write']['data']['remark'])?></td>
        </tr>
    </table>
</div>
<form class="form-inline" role="form" method="post">
    <input type="hidden" name="do" id="do" />
    <ul class="pager">
        <li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
        <?=$continue?>
    </ul>
</form>

    </div>