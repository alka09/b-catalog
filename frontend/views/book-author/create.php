<?php

use app\models\bookauthors\BookAuthor;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var BookAuthor $model */
/* @var $authors */
/* @var $books */

$this->title = 'Create Book Author';
$this->params['breadcrumbs'][] = ['label' => 'Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="book-author-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'authors' => $authors,
            'books' => $books,
        ]) ?>

</div>