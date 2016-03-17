<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
//use frontend\assets\UeditorAsset;
use common\widgets\Alert;
//UeditorAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('tbhome', 'Vcards123'),
//        'brandLabel' => ['label' => Yii::t('tbhome', 'Vcards'), 'class' => 'h1'],

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => \Yii::t('tbhome', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('tbhome', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('tbhome', 'Contact'), 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('tbhome', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('tbhome', 'Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::t('tbhome', 'Login').'(' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
                <span style="float: right;">
        <a style="" href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'zh-CN']);?>">中文123</a> /
        <a style="" href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'en-US']);?>">English123</a>
        </span>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>
	</div>
</div>	
		
<!--
        <script id="editor3" type="text/plain" name="content3" style="width:100%;height:500px;">
{$data.content3|htmlspecialchars_decode=###}
</script>
        <script type="text/javascript">
            var ue3 = UE.getEditor('editor3',{
                    toolbars: [
                        ['fullscreen', 'source', 'undo', 'redo','paragraph','fontfamily','fontsize', 'justifyleft', 'justifyright', 'justifycenter','link','unlink','emotion', 'simpleupload', 'insertimage', 'map','print', 'spechars','horizontal'],
                        ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'cleardoc','drafts', 'background', 'preview']
                    ]
//,initialStyle:'p{line-height:1em; font-size: 20px; }'
                }
            );

            ue3.ready(function(){
                ue3.execCommand('serverparam', {'uid': ''
                });
            });

        </script>
-->


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('tbhome', 'Vcards').' '.date('Y') ?></p>

        <p class="pull-right"><?= 'Vcards'//Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
