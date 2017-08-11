<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "img_to_post".
 *
 * @property integer $id
 * @property integer $id_post
 * @property integer $id_image
 */
class ImgToPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'img_to_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'id_image'], 'required'],
            [['id_post', 'id_image'], 'integer'],
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
            'id_image' => 'Id Image',
        ];
    }
}
