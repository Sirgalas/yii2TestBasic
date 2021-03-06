<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */
$this->params['body-class'] = 'modal';
$this->title = 'Update Post: ' . $model->title;
/*$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="row">
    <div class="post-update col-md-6">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'imageUpload'=>$imageUpload
        ]) ?>

    </div>
</div>
