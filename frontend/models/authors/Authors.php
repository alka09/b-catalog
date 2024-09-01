<?php

namespace app\models\authors;

use app\models\bookauthors\BookAuthor;
use app\models\books\Books;
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

    public function getAuthorsForReport($year) {

        $authors = Yii::$app->db->createCommand('
        SELECT bab.surname, COUNT(*) as books_count
FROM
    (
        Select b.title,b.year_of_issue,a.surname, count(*) as ct from books as b
        Join book_author as b_a on b_a.book_id = b.id
        Join authors as a on b_a.author_id = a.id
        where b.year_of_issue =:year

        Group by b.title,b.year_of_issue,a.surname
    ) as bab
GROUP BY bab.surname
order by books_count DESC
limit 10
        ')->bindValue(':year', $year)->queryAll();



        return $authors;
    }
}
