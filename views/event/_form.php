<?php

use yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

$to = array_merge([-1 => 'Текущий пользователь'], ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username')) ;
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->dropDownList(ArrayHelper::map(\app\models\EventCode::find()->all(), 'name', 'title')) ?>

    <?= $form->field($model, 'from_user_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'to')->dropDownList($to, ['prompt' => 'Для всех']) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'types')->listBox(ArrayHelper::map(\app\models\EventType::find()->all(), 'id', 'name'), ['multiple' => 'true']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
