<?php

namespace app\modules\message\controllers;

use Yii;
use app\modules\message\models\MessageUser;
use app\modules\message\models\MessageUserSearh;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageUserController implements the CRUD actions for MessageUser model.
 */
class MessageUserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MessageUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageUserSearh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {
            $bookId = Yii::$app->request->post('editableKey');
            $model = MessageUser::findOne($bookId);
            $out = Json::encode(['output'=>'', 'message'=>'']);
            $posted = current($_POST['MessageUser']);
            $post = ['MessageUser' => $posted];
            if ($model->load($post)) {
                $model->save();
                $output = '';
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            echo $out;
            return ;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new MessageUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

   
    protected function findModel($id)
    {
        if (($model = MessageUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
