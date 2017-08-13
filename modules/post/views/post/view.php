<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'imgViews:html',
            'content:html',
            'preview:html',
            'create_at:datetime',
            'update_at:datetime',
            'autorName',
            'status'
        ],
    ]) ?>

</div>