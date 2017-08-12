<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\models\UsersSearch $searchModel
 */

$this->title = Yii::t('user', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<?= $this->render('/admin/_menu') ?>

<?php Pjax::begin() ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout'       => "{items}\n{pager}",
    'columns' => [
        'id',
        'username',
        'email:email',
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                if (extension_loaded('intl')) {
                    return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                } else {
                    return date('Y-m-d G:i:s', $model->created_at);
                }
            },
        ],
        [
            'attribute' => 'last_login_at',
            'value' => function ($model) {
                if (!$model->last_login_at || $model->last_login_at == 0) {
                    return Yii::t('user', 'Never');
                } else if (extension_loaded('intl')) {
                    return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->last_login_at]);
                } else {
                    return date('Y-m-d G:i:s', $model->last_login_at);
                }
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{create} {switch} {resend_password} {updateModal} {update} {delete}',
            'buttons' => [
                'create'=>function ($url, $model, $key) {
                    return \yii\bootstrap\Modal::widget([
                        'id' => 'create-modal',
                        'toggleButton' => [
                            'label' => '<span class="glyphicon glyphicon-plus" aria-hidden="true" title="Create modal"></span>',
                            'tag' => 'a',
                            'data-target' => '#create-modal',
                            'href' => Url::toRoute([\Yii::getAlias('//admin/creates')]),
                        ],
                        'clientOptions' => false,
                    ]);
                },
                'resend_password' => function ($url, $model, $key) {
                    if (!$model->isAdmin) {
                        return '
                    <a data-method="POST" data-confirm="' . Yii::t('user', 'Are you sure?') . '" href="' . Url::to(['resend-password', 'id' => $model->id]) . '">
                    <span title="' . Yii::t('user', 'Generate and send new password to user') . '" class="glyphicon glyphicon-envelope">
                    </span> </a>';
                    }
                },
                'switch' => function ($url, $model) {
                    if($model->id != Yii::$app->user->id && Yii::$app->getModule('user')->enableImpersonateUser) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', ['/user/admin/switch', 'id' => $model->id], [
                            'title' => Yii::t('user', 'Become this user'),
                            'data-confirm' => Yii::t('user', 'Are you sure you want to switch to this user for the rest of this Session?'),
                            'data-method' => 'POST',
                        ]);
                    }
                },
                'updateModal'=>function ($url, $model, $key) {
                    //return Html::a('<span class="glyphicon glyphicon glyphicon-picture" aria-label="Image"></span>', Url::to([\Yii::getAlias('//admin/update'),'id'=>$model->id]));
                   return \yii\bootstrap\Modal::widget([
                        'id' => 'update-modal',
                        'toggleButton' => [
                            'label' => '<span class="glyphicon  glyphicon-wrench" aria-hidden="true" title="Update modal"></span>',
                            'tag' => 'a',
                            'data-target' => '#update-modal',
                            'href' => Url::toRoute([\Yii::getAlias('//admin/updates'),'id'=>$model->id]),
                        ],
                        'clientOptions' => false,
                    ]);
                },
            ]
        ],
    ],
]); ?>
<?php Pjax::end() ?>
