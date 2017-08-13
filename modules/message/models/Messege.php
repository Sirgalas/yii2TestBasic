<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.08.17
 * Time: 18:30
 */

namespace app\modules\message\models;


use yii\base\Model;
use dektrium\user\models\User;

class Messege extends Model
{
    
    public function message($model){
            foreach ($model->handler as $handler){
                $users= User::find()->where([$handler['feild']=>1])->all();
                foreach ($users as $user){
                    if($model->autor_id!=$user->id){
                        $handlerMethod=$handler['metod'];
                        $this->on($model->events,[$model,$model->$handlerMethod($handler['from'],$user,$handler['subject'],$handler['options'],$model)]);
                    }
                 }
            }
    }
    
}