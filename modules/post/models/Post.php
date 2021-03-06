<?php

namespace app\modules\post\models;

use app\modules\message\models\MessageUser;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\editable\Editable;
use dektrium\user\models\User;
use app\modules\message\behaviors\MessageBehaviors;
use app\modules\message\models\Messege;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property string $preview
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $autor_id
 * @property string $status
 */
class Post extends \yii\db\ActiveRecord
{
    private $columnStatusRedact;
    private $columnStatusUser;
    private $actionColumn;
    private $user;
    public function __construct(){

        $this->user=Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id);
        parent::__construct();
    }

    public function behaviors()
    {
        return [
            'mailMessage' => [
                'class'             =>  MessageBehaviors::className(),
                'handler'              =>  [
                    [
                        'type'      =>  'mail',
                        'feild'     =>  'email_massage',
                        'metod'     =>  'emailMessage',
                        'from'      =>  \Yii::$app->params['adminEmail'],
                        'subject'   =>  'new post',
                        'options'   =>  '@app/modules/message/mail/post'
                    ],
                    [
                        'type'      =>  'alert',
                        'feild'     =>  'broweser_massage',
                        'metod'     =>  'alertMessage',
                        'from'      =>  Yii::$app->user->identity->id,
                        'subject'   =>  '<strong>Good afternoon!</strong> Thank you for visiting our site. We hasten to inform you that during your absence, new posts were posted on our website. Information about them you can see in the message section',
                        'options'   =>  null
                    ]
                ],
                'events'            =>  'Post:EVENT_AFTER_INSERT',
                'handlerName'       =>  ['mail','alert']

            ],
        ];
    }

    public function getImage(){
        return $this->hasOne(Image::className(),['id_post'=>'id']);
    }

    public function getAutor(){
        return $this->hasOne(User::className(),['id'=>'autor_id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'content', 'create_at', 'update_at', 'autor_id'], 'required'],
            [['content', 'status'], 'string'],
            [['create_at', 'update_at', 'autor_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['alias', 'preview'], 'string', 'max' => 610],
        ];
    }

    public function saves($model){
        $message=new Messege();
        $model->create_at=time();
        $model->update_at=time();
        $model->autor_id=\Yii::$app->user->identity->id;
        $model->status='active';
        if($model->save()){
            return $message->message($model);;
        }
        return var_dump($model->getError);
    }
    
    public function alertMessage($from,$user,$subject,$options,$model){

        $alert=new MessageUser([
            'id_user'       =>  $user->id,
            'fromMessage'  =>   $from,
            'subject'       =>  $subject,
            'text'          =>  Html::encode('For your absence was added post ').$model->title. Html::a(' Click go',Url::to(['post/post/view','id'=>$model->id])),
            'id_post'       =>  $model->id
        ]);
        $alert->save();
    }

    public function emailMessage($from,$user,$subject,$options,$model){
        Yii::$app->mailer->compose($options,['id'=>$model->id])
            ->setFrom($from)
            ->setTo($user->email)
            ->setSubject($subject)
            ->send();
    }

    public function renderClassStatus($value)
    {
        switch ($value) {
            case 'active':
                $class = 'success';
                break;
            default:
                $class = 'default';
        }
        return $class;
    }
    
    
    public function getImgViews(){
        return Html::img($this->image->path.'/'.$this->image->name);
    }
    
    public function getAutorName(){
        return $this->autor->username;
    }
    
    public  function getColumnStatusRedact($model){
        $this->columnStatusRedact= Editable::widget([
            'name'=>"status[$model->id]",
            'asPopover' => true,
            'inputType' => Editable::INPUT_DROPDOWN_LIST,
            'displayValue' => $model->status,
            'data' => ['active'=>'active','blocked'=>'blocked']
        ]);
        return $this->columnStatusRedact;
    }

    public function getActionColumn($id)
    {
        $this->actionColumn=\yii\bootstrap\Modal::widget([
            'id' => 'update-modal',
            'toggleButton' => [
                'label' => '<span class="glyphicon  glyphicon-wrench" aria-hidden="true" title="Update modal"></span>',
                'tag' => 'a',
                'data-target' => '#update-modal',
                'href' => Url::to(['update','id'=>$id]),
            ],
            'clientOptions' => false,
        ]);
        return $this->actionColumn;
    }

    public function getTheStatus($model){
        return $this->statusSwitch($model,$this->user,$this->getColumnStatusRedact($model),false);
    }

    public function actionColumn($model){
            return $this->statusSwitch($model, $this->user, $this->getActionColumn($model->id),false);

    }
    private function statusSwitch($model,$user,$redact,$noRedact){
        if($this->userPermission(true)){
            switch ($user){
                case !empty($user['admin']):
                    $column_status=$redact;
                    break;
                case (Yii::$app->user->identity->id==$model->autor_id):
                    $column_status=$redact;
                    break;
                default:
                    $column_status=$noRedact;

            }
            return $column_status;
        }
        return false;
    }
    public function userPermission($type=false){
        if($type){
            if($this->user['admin'] || $this->user['manager'])
                return true;

            return false;
        }
        if(Yii::$app->user->isGuest)
            return false;
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'content' => 'Content',
            'preview' => 'Preview',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'autor_id' => 'Autor ID',
            'status' => 'Status',
        ];
    }
}
