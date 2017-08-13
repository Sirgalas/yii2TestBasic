<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\message\models\MessageUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_post')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'viewd')->dropDownList([ 'не прочитано' => 'не прочитано', 'прочитано' => 'прочитано', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
