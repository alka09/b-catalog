<?php

use app\models\authors\Authors;
use app\models\books\Books;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\bookauthors\BookAuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'book_id',
                'filter' => Books::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'book.title',
            ],
            [
                'attribute' => 'author_id',
                'filter' => Authors::find()->select(['surname', 'id'])->indexBy('id')->column(),
                'value' => 'author.surname',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
