<?php

namespace app\models\authors;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the ActiveQuery class for [[Authors]].
 */
class AuthorsSearch extends Authors {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['id'], 'integer'],
            [['surname', 'name', 'patronymic'], 'string'],
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
        $query = Authors::find();

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
     * {@inheritdoc}
     * @return Authors[]|array
     */
    public function all($db = null): array {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Authors|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }
}
