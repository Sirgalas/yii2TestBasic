<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.08.17
 * Time: 17:09
 */

namespace app\modules\message\behaviors;
use yii\base\Behavior;

class MessageBehaviors extends Behavior
{
    public $handler;
    public $events;
    public $handlerName;
    public $modelThis;
    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return mixed
     */
    public function getHandlerName()
    {
        return $this->handlerName;
    }

    /**
     * @return mixed
     */
    public function getModelThis()
    {
        return $this->modelThis;
    }
}