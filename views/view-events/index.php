<?php

use \yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

yii\widgets\Pjax::begin();
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_event'
]);
yii\widgets\Pjax::end();
