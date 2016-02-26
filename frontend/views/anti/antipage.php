<?php

use frontend\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-param" content="_csrf">
        <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>">
        <title><?=$antireply->tag?></title>
        <style type = "text/css">
            img{max-width:100%;}
            <!--body{font-family:"微软雅黑,宋体"; line-height:1.5em; font-size: 18px; }-->
        </style>

        <?php $this->head() ?>
    </head>

    <body style="padding-top: 5px; padding-bottom: 5px;">
    <?php $this->beginBody() ?>

    <div class="container">
        <?=$queryResult?>

    </div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>