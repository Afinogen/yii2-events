<?php
/* @var $this yii\web\View */
/** @var $model \app\models\UserEvent */
?>
<div class="alert alert-<?= $model->is_read ? 'info' : 'warning' ?>">
    Дата: <?= date('d.m.Y H:i:s', $model->created_at) ?><br>
    От: <?= $model->event->fromUser->username ?><br>
    Тема: <?= $model->subject ?><br>
    Сообщение: <?= $model->body ?><br>
    <?php
    if (!$model->is_read) {
        echo \yii\helpers\Html::a('Прочитано', ['view-events/read', 'id' => $model->id], ['class' => 'btn btn-primary']);
    } ?>
</div>