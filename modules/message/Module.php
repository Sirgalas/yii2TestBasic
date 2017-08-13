<?php

namespace app\modules\message;

/**
 * message module definition class
 */
class Module extends \yii\base\Module
{
    public $models;
    public $user;
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\message\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public function getAllModels(){
        
        return $this->models;
    }
    public function getUser(){
        return $this->user;
    }
}
