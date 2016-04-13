<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 11.04.16
 * Time: 12:03
 */

namespace app\commands;

use app\models\UserGroupRule;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
    /**
     * Создание ролей
     */
    public function actionInit()
    {
        Console::output('Add roles');

        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $userRule = new UserGroupRule();
        $auth->add($userRule);

        $user = $auth->createRole('user');
        $user->ruleName = $userRule->name;
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $admin->ruleName = $userRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $user);

        Console::output('ok');
    }
}