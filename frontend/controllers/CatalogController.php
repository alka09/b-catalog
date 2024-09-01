<?php

namespace frontend\controllers;

use app\models\books\Books;
use app\models\books\BooksSearch;
use app\models\authors\Authors;
use app\models\authors\AuthorsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 *
 */
class CatalogController extends Controller {


    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Books::find()->orderBy('id'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $author
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAuthor($author): string
    {
        $author = $this->findAuthorModel($author);

        $dataProvider = new ActiveDataProvider([
            'query' => (new BooksSearch)->forAuthor($author->id)->orderBy('id'),
        ]);

        return $this->render('author', [
            'author' => $author,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $model = $this->findBookModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param string $name
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAuthorModel(string $name): Authors
    {
        if (($model = Authors::findOne(['name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findBookModel(int $id): Books
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}