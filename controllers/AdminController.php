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

/**
 * Class AdminController
 * @package app\controllers
 */
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

    /**
     * Главная страничка админки
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}