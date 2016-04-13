<?php
/**
 * Created by PhpStorm.
 * User: afinogen
 * Date: 11.04.16
 * Time: 12:41
 */

namespace app\models;

use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $role = \Yii::$app->user->identity->role_id;
            if ($item->name === 'admin') {
                return $role == User::ROLE_ADMIN;
            } elseif ($item->name === 'user') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}