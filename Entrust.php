<?php

namespace vmorozov\entrust;
use vmorozov\entrust\models\Permission;
use vmorozov\entrust\models\Role;

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
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
