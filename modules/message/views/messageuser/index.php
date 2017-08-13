<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\message\models\MessageUserSearh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Message Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Message User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_post',
            'id_user',
            'viewd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
