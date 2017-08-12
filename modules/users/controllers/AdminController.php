<?php

namespace app\controllers;

use yii\helpers\Url;
use app\models\UsersSearch;
use dektrium\user\controllers\AdminController as BaseAdminController;
use dektrium\user\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

class AdminController extends BaseAdminController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel  = new UsersSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render(\Yii::getAlias('//admin/index'), [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
    public function actionCreates()
    {
        /** @var User $user */
        $user = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'create',
        ]);
        $event = $this->getUserEvent($user);

        $this->performAjaxValidation($user);

        $this->trigger(self::EVENT_BEFORE_CREATE, $event);
        if ($user->load(\Yii::$app->request->post()) && $user->create()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
            $this->trigger(self::EVENT_AFTER_CREATE, $event);
            return $this->redirect(['update', 'id' => $user->id]);
        }

        return $this->renderPartial(\Yii::getAlias('//admin/create'), [
            'user' => $user,
        ]);
    }
    public function actionUpdates($id)
    {
        Url::remember('', 'actions-redirect');
        $user = $this->findModel($id);
        $user->scenario = 'update';
        $event = $this->getUserEvent($user);

        $this->performAjaxValidation($user);

        $this->trigger(self::EVENT_BEFORE_UPDATE, $event);
        if ($user->load(\Yii::$app->request->post()) ) {
            $user->updated_at=time();
            if($user->save()){
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Account details have been updated'));
                $this->trigger(self::EVENT_AFTER_UPDATE, $event);
                return $this->refresh();
            }

        }
        return $this->renderPartial(\Yii::getAlias('//admin/update'), [
            'user' => $user,
        ]);
    }

    protected function findModel($id)
    {
        $user = $this->finder->findUserById($id);
        if ($user === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $user;
    }
    
}