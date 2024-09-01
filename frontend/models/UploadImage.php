<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Модель загрузки изображения
 */
class UploadImage extends Model {

    public $image;

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return[
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @return false|void
     */
    public function upload($image){
        $pathToSave = static::getPathToSaveImage($image); //returns  path to your photo
        return $image->saveAs($pathToSave);
    }
}