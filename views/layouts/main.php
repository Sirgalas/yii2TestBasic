<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
$user=Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id);
AppAsset::register($this);

if(Yii::$app->user->isGuest){
    $arrReg=['label' => 'Login', 'url' => ['/user/security/login']];
    $arrGuest=['label' => 'Sigin', 'url'=>['/user/registration/register']];
}else{
    $arrReg=['label' => 'Profile',  'url' => ['/user/settings/profile']];
    $arrGuest=['label' => 'Logout',  'url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']];
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap ">
    <?php if(!isset($this->params['body-class'])){ ?>
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            !empty($user['admin'])?
                (['label' => 'User redact',  'url' => ['/user/admin/index ']]):'',
            !Yii::$app->user->isGuest?(['label' => 'Message',  'url' => ['/message/message-user/index ']]):'',
            $arrReg,
            $arrGuest
        ],
    ]);
    NavBar::end();
    ?>

        <div class="<?= $this->params['body-class'] ?>">
    <?php } ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?php if(!isset($this->params['body-class'])){ ?>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
