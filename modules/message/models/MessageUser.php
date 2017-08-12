<?php

namespace app\modules\message;

use Yii;

/**
 * This is the model class for table "message_user".
 *
 * @property integer $id
 * @property integer $id_post
 * @property integer $id_user
 * @property string $viewd
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
            [['id_post', 'id_user'], 'required'],
            [['id_post', 'id_user'], 'integer'],
            [['viewd'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_post' => 'Id Post',
            'id_user' => 'Id User',
            'viewd' => 'Viewd',
        ];
    }
}
