<?php

namespace app\modules\post\models;


use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $path
 * @property string $name
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'name','id_post'], 'required'],
            [['path', 'name'], 'string', 'max' => 610],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_post'=> 'Id Post',
            'path' => 'Path',
            'name' => 'Name',
        ];
    }
}
