<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'id_post',
                'format'=>'raw',
                'value'=> function($model){
                    return Html::encode('For your absence was added').$model->post->title. Html::a('Click go',Url::to(['post/post/view','id'=>$model->id_post]));
                }
            ],

            ['class' => 'yii\grid\ActionColumn','template' => '{delete}'],
        ],
    ]); ?>
</div>
