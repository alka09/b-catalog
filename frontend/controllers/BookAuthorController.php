<?php

namespace frontend\controllers;

use app\models\authors\Authors;
use app\models\bookauthors\BookAuthor;
use app\models\bookauthors\BookAuthorSearch;
use app\models\books\Books;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 *
 */
class BookAuthorController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors(): array {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BookAuthor models
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookAuthorSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BookAuthor model.
//     * @param integer $book_id
//     * @param integer $author_id
     * @return mixed
     */
    public function actionView(int $id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single BookAuthor model.
     *
     * @return mixed
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new BookAuthor();

        $books = ArrayHelper::map(Books::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title' );

        $authors = ArrayHelper::map(Authors::find()->select(['id', 'surname'])->asArray()->all(), 'id', 'surname' );

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'books' => $books,
            'authors' => $authors,
        ]);
    }

    /**
     * Updates an existing BookAuthor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $book_id
     * @param integer $author_id
     * @return mixed
     */
    public function actionUpdate(int $book_id, int $author_id)
    {
        $model = $this->findModel($book_id, $author_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'book_id' => $model->book_id, 'author_id' => $model->author_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BookAuthor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $book_id
     * @param integer $author_id
     * @return mixed
     */
    public function actionDelete(int $book_id, int $author_id)
    {
        $this->findModel($book_id, $author_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BookAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @return BookAuthor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): BookAuthor {
        if (($model = BookAuthor::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена.');
        }
    }
}