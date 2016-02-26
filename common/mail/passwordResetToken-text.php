<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<?=Yii::t('tbhome', 'Hello')?>： <?= $user->username ?>,
<?=Yii::t('tbhome', 'Follow the link below to reset your password:')?>

<?= $resetLink ?>
