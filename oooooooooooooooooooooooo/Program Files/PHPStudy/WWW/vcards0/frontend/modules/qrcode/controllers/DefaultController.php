<?php

namespace frontend\modules\qrcode\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout='@frontend/views/layouts/user';
    public function actionIndex()
    {
        return $this->render('index');
    }
}
