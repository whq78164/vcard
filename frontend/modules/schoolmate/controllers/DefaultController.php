<?php

namespace frontend\modules\schoolmate\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(array('/schoolmate/schoolmate/view', 'id' =>5 ));
    }
}
