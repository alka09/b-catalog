<?php

namespace app\models\bookauthors;

use app\models\authors\Authors;
use app\models\books\Books;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы "{{%book_author}}"
 *
 * @property int $id        [int(11)]
 * @property int $book_id   [int(11)]
 * @property int $author_id [int(11)]
 */
class BookAuthor extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%book_author}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return [
            'book_id' => 'Идентификатор книги',
            'author_id' => 'Идентификатор автора',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }
}