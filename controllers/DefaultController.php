<?php

namespace vmorozov\entrust\controllers;

use yii\web\Controller;

/**
 * Default controller for the `entrust` module
 */
class WebAuthController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
