<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $content
 * @property string $img
 * @property string $preview
 * @property integer $create_at
 * @property integer $update_at
 */
class Post extends \yii\db\ActiveRecord
{
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
            [['title', 'alias', 'content', 'img', 'preview', 'create_at', 'update_at'], 'required'],
            [['content'], 'string'],
            [['create_at', 'update_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['alias', 'img', 'preview'], 'string', 'max' => 610],
        ];
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
            'img' => 'Img',
            'preview' => 'Preview',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
