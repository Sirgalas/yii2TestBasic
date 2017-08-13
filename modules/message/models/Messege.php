<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.08.17
 * Time: 18:30
 */

namespace app\modules\message\models;


use yii\base\Model;

class Massege extends Model
{
    
    public function message(){
        $models=$this->module->allModels;
        return $models;
    }
    
}