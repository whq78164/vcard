<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public $enableCsrfValidation = false;//禁用CSRF了

    public function actionIndex()
    {
        return $this->render('index');
    }
}
