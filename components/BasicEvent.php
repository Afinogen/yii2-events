<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 13.04.16
 * Time: 9:41
 */

namespace app\components;


use app\models\EventType;
use yii\base\Component;
use app\models\Event;
use app\models\User;
use app\models\UserEvent;

/**
 * Class BasicEvent
 *
 * @package app\components
 */
class BasicEvent extends Component
{
    /**
     * Генерация сообщений для пользователей
     *
     * @param Event $event
     * @param $object
     * @param EventType $type
     *
     * @return bool
     */
    public static function generateEvents($event, $object, $type)
    {
        $users = [];
        if ($event->to == 0) {
            $users = User::find()->all();
        } elseif ($event->to == -1 && !\Yii::$app->user->isGuest) {
            $users[] = User::find()->where(['id' => \Yii::$app->user->id])->one();
        } elseif ($event->to > 0) {
            $users[] = User::find()->where(['id' => $event->to])->one();
        }

        if (count($users) > 0) {
            $templates = array_merge(self::getTemplateVariables(), $object->getTemplateVariables());

            /** @var User $user */
            foreach ($users as $user) {
                $templates['{username}'] = $user->username;

                $userEvent = new UserEvent();
                $userEvent->user_id = $user->id;
                $userEvent->event_id = $event->id;
                $userEvent->type_id = $type->id;
                $userEvent->is_read = 0;
                $userEvent->subject = strtr($event->subject, $templates);
                $userEvent->body = strtr($event->body, $templates);
                $userEvent->save();
            }

            return true;
        }

        return false;
    }

    /**
     * Глобальные перменные, которые используются во всех шаблонах
     *
     * @return array
     */
    public static function getTemplateVariables()
    {
        return [
            '{username}' => \Yii::$app->user->isGuest ? 'Гость' : \Yii::$app->user->identity->username,
            '{sitename}' => 'Test site',
        ];
    }
}