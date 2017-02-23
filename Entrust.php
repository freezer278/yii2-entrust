<?php

namespace vmorozov\entrust;

/**
 * entrust module definition class
 */
class Entrust extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'vmorozov\entrust\controllers';

    /**
     * Array with custom views for login, registration, password recovery.
     *
     * @var array
     */
    public $customViews = [];

    /**
     * Array with custom views for emails.
     *
     * @var array
     */
    public $customMailViews = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
