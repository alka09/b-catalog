<?php

namespace app\models\books;

use app\models\authors\Authors;
use app\models\bookauthors\BookAuthor;
use app\models\bookauthors\BookAuthorSearch;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\imagine\Image;

/**
 * This is the model class for table "books".
 *
 * @property int            $id
 * @property string         $title          Название
 * @property int            $year_of_issue  Год выпуска
 * @property string|null    $description    Описание
 * @property int|null       $isbn
 * @property string|null    $photo          Фото обложки
 *
 * @property BookAuthor[] $bookAuthors
 */
class Books extends ActiveRecord {

    /**
     * Вспомогательный атрибут для загрузки изображения
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['title', 'year_of_issue'], 'required'],
            [['year_of_issue'], 'integer'],
            [['isbn'], 'boolean'],
            [['title', 'description', 'photo'], 'string', 'max' => 255],
            ['photo', 'image', 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'year_of_issue' => 'Год выпуска',
            'description' => 'Описание',
            'isbn' => 'Isbn',
            'photo' => 'Фото обложки',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery|BookAuthorSearch
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, ['book_id' => 'id']);
    }

    /**
     * Связь с сущностью "Автор"
     *
     * @return ActiveQuery
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Authors::className(), ['id' => 'author_id'])->viaTable('{{%book_author}}', ['book_id' => 'id']);
    }

    /**
     * Загружает файл фото обложки
     */
    public function uploadImage() {
        if ($this->imageFile) { // только если был выбран файл для загрузки
            $name = md5(uniqid(rand(), true)) . '.' . $this->imageFile->extension;
            $source = Yii::getAlias("@webroot/images/photo/$name");

            $this->imageFile->saveAs($source);

            $thumb = Yii::getAlias('@webroot/images/thumb/' . $name);
            Image::thumbnail($source, 250, 250)->save($thumb, ['quality' => 90]);

            return $name;
        }

        return false;
    }

    /**
     * Возвращает путь к загруженному изображению
     *
     * @param $photo
     *
     * @return string|void
     */
    public function getPhotoPath($photo) {
        if ($this->photo) {
            return "@web/images/thumb/$photo";
        }
    }

    /**
     * Удаляет старое изображение при загрузке нового
     */
    public function removeImage($photo) {
        if (!empty($photo)) {
            $source = "images/photo/$photo";
            if (is_file($source)) {
                unlink($source);
            }
            $thumb = "images/thumb/$photo";
            if (is_file($thumb)) {
                unlink($thumb);
            }
        }
    }
}
