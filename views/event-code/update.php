<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventCode */

$this->title = 'Update Event Code: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Event Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
