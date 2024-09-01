<?php

namespace app\models\authors;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $surname Фамилия
 * @property string $name Имя
 * @property string|null $patronymic Отчество
 *
 * @property BookAuthor[] $bookAuthors
 */
class Authors extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return '{{%authors}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['surname', 'name'], 'required'],
            [['surname', 'name', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
        ];
    }

//    /**
//     * Gets query for [[BookAuthors]].
//     *
//     * @return ActiveQuery|BookAuthorQuery
//     */
//    public function getBookAuthors()
//    {
//        return $this->hasMany(BookAuthor::class, ['author_id' => 'id']);
//    }
}
