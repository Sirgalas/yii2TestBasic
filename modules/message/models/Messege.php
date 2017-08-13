<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.08.17
 * Time: 18:30
 */

namespace app\modules\message\models;


use yii\base\Model;

class Messege extends Model
{
    
    public function message($models,$userModel){
        foreach ($models as $modelsConfig){
            $modelConfig= new $modelsConfig;
            $beh[]=$modelConfig->behaviors;
            /*foreach ($model->handler as $handler){
                $users=$userModel::find()->where([$handler['feild']=>1])->all();
                $beh[]=$handler['text'];
                foreach ($users as $user){
                    $handlerMethod=$handler['metod'];
                    $this->on($model->events,[$model,$model->$handlerMethod($handler['from'],$user->email,$handler['subject'],$handler['text'],$handler['options']['address'],$handler['options']['id'])]);
                }
             }*/
        }
        return $beh;
    }
    public function  sendMessage(){
        
    }
    
}