<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/post/post/view', 'id' => 1]);
?>
<div class="new-post">
    <p>Hello in project <?=\Yii::$app->name ?>.</p>

    <p>Add new post You can follow it by </p>

    <p><?= Html::a(Html::encode('link'), $resetLink) ?></p>
</div>