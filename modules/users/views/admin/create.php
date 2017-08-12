<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?php
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-sm-9',
                ],
            ],
        ]);
        ?>
        <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($user, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>