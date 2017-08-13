<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10.08.17
 * Time: 13:06
 */

namespace app\modules\post\models;

use app\models\ImgToPost;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

class ImageUpload extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    public function upload($idPost){
        $uploadPath=\Yii::getAlias('@app').'/web/image/post/'.date('Y').'/'.date('m');
        BaseFileHelper::createDirectory($uploadPath);

        if ($this->validate()) {
                $imageFile=$uploadPath . '/' . $this->imageFile->baseName.'.'.$this->imageFile->extension;
                $this->imageFile->saveAs($imageFile);
                $saveImage=$this->saveImage(\Yii::getAlias('@web').'/image/post/'.date('Y').'/'.date('m'),$this->imageFile->baseName.'.'.$this->imageFile->extension,$idPost);
                if(!$saveImage){
                    return false;
                }
                return $saveImage;
        } 
        return var_dump($this->getErrors());
    }

    protected function  saveImage($uploadPath,$name,$idPost){
        $image=new Image([
            'path'=>$uploadPath,
            'name'=>$name,
            'id_post'=>$idPost
        ]);
        if($image->save()){
                return false;
        }
        return var_dump($image->getErrors());
    }


}