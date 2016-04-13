<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EventCode */

$this->title = 'Create Event Code';
$this->params['breadcrumbs'][] = ['label' => 'Event Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
