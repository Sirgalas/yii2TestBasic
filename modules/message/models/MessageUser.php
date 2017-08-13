<?php

namespace app\modules\message\models;

use Yii;

/**
 * This is the model class for table "message_user".
 *
 * @property integer $id
 * @property integer $id_post
 * @property integer $id_user
 * @property string $viewd
 * @property integer $fromMessage
 * @property string $subject
 * @property string $text
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
            [['id_user', 'fromMessage', 'subject', 'text'], 'required'],
            [['id_post', 'id_user', 'fromMessage'], 'integer'],
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
        ];
    }
}
