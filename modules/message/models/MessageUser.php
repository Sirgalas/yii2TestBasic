<?php

namespace app\modules\message\models;

use Yii;

/**
 * This is the model class for table "message_user".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $viewd
 * @property integer $fromMessage
 * @property string $subject
 * @property string $text
 * @property integer $id_post
 */
class MessageUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'fromMessage', 'subject', 'text', 'id_post'], 'required'],
            [['id_user', 'fromMessage', 'id_post'], 'integer'],
            [['viewd', 'text'], 'string'],
            [['subject'], 'string', 'max' => 610],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'viewd' => 'Viewd',
            'fromMessage' => 'From Message',
            'subject' => 'Subject',
            'text' => 'Text',
            'id_post' => 'Id Post',
        ];
    }
}
