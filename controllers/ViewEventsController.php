<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 13.04.16
 * Time: 9:47
 */

namespace app\controllers;


use app\models\UserEventSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

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
    
    public function actionIndex()
    {
        $searchModel = new UserEventSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}