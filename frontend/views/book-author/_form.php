<?php

use app\models\authors\Authors;
use app\models\bookauthors\BookAuthor;
use app\models\books\Books;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var View $this */
/* @var BookAuthor $model */
/* @var ActiveForm $form */
/* @var authors $authors */
/* @var books $books */
?>

<div class="book-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_id')->dropDownList($books) ?>

    <?= $form->field($model, 'author_id')->dropDownList($authors) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
