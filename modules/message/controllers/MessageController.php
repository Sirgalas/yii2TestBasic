<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.08.17
 * Time: 16:30
 */

namespace app\modules\message\controllers;



use app\modules\message\models\Messege;
use yii\web\Controller;

class MessageController extends  Controller
{
    public function actionIndex(){
        $model= new Messege();
        $models= $this->module->allModels;
        $user= new $this->module->user;
        return var_dump($model->message($models,$user));
    }
}