<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Site;
//use mdm\admin\components\MenuHelper;

$response=Site::findOne(['id'=>1]);
//$url=Yii::$app->params['updateApi'];
//$response=httpGet($url);
//$response=json_decode($response);
/*
switch ($response->status){
    case 9 :// header('location: '.Yii::$app->homeUrl);
      //  Yii::$app->getSession()->setFlash('danger', $response->msg);
        break;
    case 0 :  //Yii::$app->getSession()->setFlash('danger', $response->msg);

        break;
}
*/

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($response->sitetitle) ?></title>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <!--div class="wrapper row-offcanvas row-offcanvas-left"-->

    <?php
    $callback = function($menu){
        $data = eval($menu['data']);
        return [
            'label' => $menu['name'],
            'url' => [$menu['route']],
            'options' => $data,
            'items' => $menu['children']
        ];
    };
 //   $items = MenuHelper::getAssignedMenu(Yii::$app->user->id);//, null, $callback);
///
    NavBar::begin([
        'brandLabel' => $response->sitetitle,//Yii::t('tbhome', 'Vcards').'微名片',
//        'brandLabel' => ['label' => Yii::t('tbhome', 'Vcards'), 'class' => 'h1'],

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
           'class' => 'navbar-inverse navbar-fixed-top',
     //       'class' => 'nav nav-tabs nav-stacked',
      //      'id'=>'main-nav'
        ],
    ]);
//*/
    $items = [
        ['label' => \Yii::t('tbhome', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('tbhome', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('tbhome', 'Contact'), 'url' => ['/site/contact']],
    ];
   if (Yii::$app->user->isGuest) {
       // $menuItems = [

     //   $menuItems[] = ['label' => Yii::t('tbhome', 'Signup'), 'url' => ['/site/signup']];
       // $menuItems[] = ['label' => Yii::t('tbhome', 'Login'), 'url' => ['/site/login']];
       $items[] = ['label' => Yii::t('tbhome', 'Signup'), 'url' => ['/site/signup']];
       $items[] = ['label' => Yii::t('tbhome', 'Login'), 'url' => ['/site/login']];
    } else {
      //  $menuItems[] = [
            $items[] = [
            'label' => Yii::t('tbhome', 'Login').':'. Yii::$app->user->identity->username,
            'url' => ['user/index'],
       //     'linkOptions' => ['data-method' => 'post']
        ];
    }
  //  $items[]=$items;
    echo Nav::widget([

        'options' => [
            'class' => 'navbar-nav navbar-right',
            //'class' => 'nav nav-tabs nav-stacked',
      //   'id'=>'main-nav'
        ],

        'items' => $items
    ]);

  NavBar::end();

    ?>

    <div class="container">
       <!--         <span style="float: right;">
        <a style="" href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'zh-CN']);?>">中文</a> /
        <a style="" href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'en-US']);?>">English</a>
        </span>
-->
        <?
    //    print_r($items);
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>
	</div>
</div>






<?//php Yii::powered()=Yii::t('tbhome', 'Vcards')?>
<footer class="footer">
    <div class="container">
        <p class="pull-left"><?= $response->copyright ?></p>
        <p class="pull-right"><?= $response->icp ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
