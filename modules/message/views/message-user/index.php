<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \yii\helpers\Url;
use \dektrium\user\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\message\models\MessageUserSearh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Message Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-user-index">

    <h1><?= Html::encode('This you message') ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'fromMessage',
                'header'=>'Autor',
                'value'=>function($model){
                    $user=User::findOne(['id'=>$model->fromMessage]);
                    return $user->username;
                }
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['прочитано'=>'прочитано', 'не прочитано'=>'не прочитано'],
                'header'=>'staus',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Select_status'],
                'attribute'=>'viewd',
                'editableOptions'=> function ($model, $key, $index) {
                    return [
                        'header'=>'staus',
                        'size'=>'md',
                        'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'displayValue' => $model->viewd,
                        'data' =>['прочитано'=>'прочитано', 'не прочитано'=>'не прочитано'],
                    ];
                }

            ],
            [
                'attribute'=>'text',
                'format'=>'raw'
            ],

            ['class' => 'yii\grid\ActionColumn','template' => '{delete}'],
        ],
    ]); ?>
</div>
