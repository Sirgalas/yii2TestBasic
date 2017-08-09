<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.08.17
 * Time: 9:45
 */

namespace app\controllers;

use yii\helpers\Url;
use app\models\UsersSearch;
use dektrium\user\controllers\AdminController as BaseAdminController;

class UseradminController extends BaseAdminController
{
    
    public function actionIndex()
    {
        $searchModel  = new UsersSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
}