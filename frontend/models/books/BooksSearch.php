<?php

namespace app\models\books;

use app\models\bookauthors\BookAuthor;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Books]].
 *
 * @see Books
 */
class BooksSearch extends Books {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['title', 'year_of_issue'], 'required'],
            [['year_of_issue'], 'integer'],
            [['isbn'], 'boolean'],
            [['title', 'description', 'photo'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios(): array
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider {
        $query = Books::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->load($params) || !$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        return $dataProvider;
   }

    /**
     * @param integer $id
     */
    public function forAuthor(int $id): ActiveQuery {
        return Books::find()->with(['bookAuthor'], false)->andWhere([BookAuthor::tableName() . '.author_id' => $id]);
    }

    /**
     * {@inheritdoc}
     * @return Books[]|array
     */
    public function all($db = null): array {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Books|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
