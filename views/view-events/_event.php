<?php
/* @var $this yii\web\View */
/** @var $model \app\models\UserEvent */
?>
<div class="alert-<?= $model->is_read ? 'info' : 'warning' ?>">
    От: <?= $model->event->fromUser->username ?><br>
    Тема: <?= $model->subject ?><br>
    Сообщение; <?= $model->body ?><br>
    <?= \yii\helpers\Html::button('Прочитано', ['class' => 'btn btn-primary']) ?>
</div>