<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 12.04.16
 * Time: 13:38
 */

namespace app\components;

use app\models\Event;
use app\models\EventHasType;

/**
 * Class HandlerEvents
 *
 * @package app\components
 */
class HandlerEvents extends \yii\base\Event
{
    /**
     * Создание нового события на основе кода (browser, email и т.д.)
     * @param \yii\base\Event $event
     */
    public static function newEvent($event)
    {
        /** @var Event[] $eventsDb */
        $eventsDb = Event::find()->where(['code' => $event->name])->all();
        
        if (count($eventsDb) > 0) {
            foreach ($eventsDb as $eventDb) {
                $msgTypes = $eventDb->getEventHasTypes()->all();

                /** @var EventHasType $msgType */
                foreach ($msgTypes as $msgType) {
                    if ($msgType->type->name == EmailEvent::EVENT_TYPE_EMAIL) {
                        EmailEvent::generateEvents($eventDb, $event->sender, $msgType->type);
                    } elseif ($msgType->type->name == BrowserEvent::EVENT_TYPE_BROWSER) {
                        BrowserEvent::generateEvents($eventDb, $event->sender, $msgType->type);
                    }
                }
            }
        }
    }
}