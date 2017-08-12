<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.08.17
 * Time: 17:09
 */

namespace app\behaviors;
use yii\base\Behavior;

class MessageBehaviors extends Behavior
{
    public $type;
    public $userModel;
    public $layoutMassage;
    public $events;
    public $user;

}