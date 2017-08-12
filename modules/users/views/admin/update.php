<?php
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>
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
        ]); ?>

        <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($user, 'password')->passwordInput() ?>
        <div class="form-group field-user-create_at">
            <?php echo '<label  class="control-label col-sm-3" for="w1">'.Yii::t('app','createAt').'</label>';
                echo '<div class="col-sm-9">';
                echo DatePicker::widget([
                'name' => 'created_at',
                'type' => DatePicker::TYPE_INPUT,
                'value' => date('d:F:Y',$user->created_at),
                'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
                ]
                ]);
                echo "</div>";
            ?>
            </div>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
                    </div>
                </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>