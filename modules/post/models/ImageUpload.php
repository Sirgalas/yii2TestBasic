<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10.08.17
 * Time: 13:06
 */

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

class ImageUpload extends Model
{
    public $fileImages;

    public function rules()
    {
        return [
            [['fileImages'], 'file',  'extensions' => 'png, jpg'],
        ];
    }

    public function upload(){
        $uploadPath=\Yii::getAlias('@app').'/web/image/post/'.date('Y').'/'.date('m');
        BaseFileHelper::createDirectory($uploadPath);

        if ($this->validate()) {
            foreach ($this->fileImages as $file) {
                $imageFile=$uploadPath . '/' . $file->baseName.'.'.$file->extension;
                if ($file->image->saveAs($imageFile)) {
                    return $imageFile;
                }
                return 'no1';
            }
        }
        return var_dump($this->getErrors());
    }
}