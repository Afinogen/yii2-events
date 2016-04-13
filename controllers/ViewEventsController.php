<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 13.04.16
 * Time: 9:47
 */

namespace app\controllers;


use app\components\BrowserEvent;
use app\models\EventType;
use app\models\UserEvent;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Class ViewEvents
 *
 * @package app\controllers
 */
class ViewEventsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Вывод браузерных событий для пользователя
     * Не прочтеные выволятся первыми
     * @return string
     */
    public function actionIndex()
    {
        $browserType = EventType::find()->where(['name' => BrowserEvent::EVENT_TYPE_BROWSER])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => UserEvent::find()->where(['user_id' => \Yii::$app->user->id, 'type_id' => $browserType->id]),
            'sort' => [
                'defaultOrder' => ['is_read' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Установка флага прочтения на событие
     * @param int $id
     * @return \yii\web\Response
     * @throws HttpException
     */
    public function actionRead($id)
    {
        /** @var UserEvent $event */
        $event = UserEvent::find()->where(['id' => $id, 'user_id' => \Yii::$app->user->id])->one();
        if ($event) {
            $event->is_read = 1;
            $event->save();
            return $this->redirect(['index']);
        }

        throw new HttpException(403, 'Ошибка доступа');
    }
}