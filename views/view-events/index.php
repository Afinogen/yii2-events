<?php

use \yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?=
ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_event',
]);
?>
