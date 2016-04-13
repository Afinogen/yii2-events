<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 12.04.16
 * Time: 9:07
 */

namespace app\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}