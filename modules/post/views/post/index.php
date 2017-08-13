<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
if(!empty($messageUsers)){
echo \yii\bootstrap\Alert::widget([
    'options' => [
        'class' => 'alert-info'
    ],
    'body' => '<strong>Good afternoon!</strong> Thank you for visiting our site. We hasten to inform you that during your absence, new posts were posted on our website. Information about them you can see in the message section'
]);
}
?>
<div class="post-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if($models->userPermission(true))
            echo Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>

        <?php echo \nterms\pagesize\PageSize::widget(); ?>
    </p>
    <?= GridView::widget([
        'id' => 'kv-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'id_img',
                'header'    =>  'Image',
                'format'    =>  'raw',
                'value'     =>  function($model){
                    return Html::img($model->image->path.'/'.$model->image->name,['alt'=>$model->title, 'width'=>200]);
                }
            ],
            Yii::$app->user->isGuest ?
                (['attribute' => 'preview', 'format'    =>  'raw',]):(['attribute' => 'content', 'format'    =>  'raw',]),
            [

                'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_from',
                'attribute2' => 'date_to',
                'type' => DatePicker::TYPE_RANGE,
                'separator' => '-',
                'pluginOptions' => ['format' => 'yyyy-mm-dd']
            ]),
                'attribute' => 'create_at',
                'format' => 'datetime',
            ],
            [
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=> ['active'=>'active', 'blocked'=>'blocked'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Select_status'],
                'attribute'=>'status',
                'format'=>'raw',
                'value'=> function($model){
                     return Html::tag('span',$model->status,['class'=>'label label-'.$model->renderClassStatus($model->status)]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {status} {view}',
                'buttons' =>
                    [
                        'update' => function ($url, $model) {
                            return  $model->actionColumn($model); },
                        'status' => function ($url, $model) {
                            return  $model->getTheStatus($model); },
                        'view'=>function($url, $model){
                            if($model->userPermission()){
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',Url::to(['/post/post/view','id'=>$model->id]));
                            }
                            return false;

                        }
                    ]
            ]
            /*$models->status($model),
           $models->actionColumn($model)*/
        ],
    ]); ?>
</div>
