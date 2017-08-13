<?php

namespace app\modules\post\controllers;

use app\modules\message\models\MessageUser;
use app\modules\post\models\ImageUpload;
use Yii;
use app\modules\post\models\Post;
use app\modules\post\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Image;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['manager'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['manager'],
                        'matchCallback' => function ($rule, $action) {
                            $model=Post::findOne(Yii::$app->request->get('id'));
                            var_dump(Yii::$app->user->identity->id===$model->autor_id);
                            return Yii::$app->user->identity->id===$model->autor_id;}
                    ],

                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['manager','user'],
                    ],
                   [
                        'actions' => ['index'],
                        'allow' => true,
                       'roles' => ['?', '@', 'manager','user'],
                   ]
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models= new Post();
        if (Yii::$app->request->post('hasEditable')) {
            $status=$_POST['status'];
            $model = $this->findModel(key($status));
            $out = Json::encode(['output'=>'', 'message'=>'']);
            $posted=current($_POST['status']);
            $post=['Post'=>$posted];
            if ($model->load($post) ){
                $model->status = $posted;
                if($model->save()){}else{
                    return var_dump($model->getErrors());
                }
                $output = '';
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }else{
                return var_dump($model->getErrors());
            }
            echo $out;
            return ;
        }
        $messageUser= MessageUser::find()->where(['id_user'=>Yii::$app->user->identity->id])->one();
        return $this->render('index', [
            'messageUsers'=>$messageUser,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'models'=>$models
        ]);
    }



    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $imageUpload= new ImageUpload();
        if ($model->load(Yii::$app->request->post())) {
            $imageUpload->imageFile = UploadedFile::getInstance($imageUpload, 'imageFile');
            $saves=$model->saves($model);
            $imageUpload->upload($model->id);
            if(!$saves){
                return $this->redirect(['index']);
            }else{
                return var_dump($saves);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'imageUpload'=>$imageUpload
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imageUpload= new ImageUpload();
        if ($model->load(Yii::$app->request->post())) {
            $imageUpload->imageFile = UploadedFile::getInstance($imageUpload, 'imageFile');
            $saves=$model->saves($model);
            $imageUpload->upload($model->id);
            if(!$saves){
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'imageUpload'=>$imageUpload
            ]);
        }
    }

    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
