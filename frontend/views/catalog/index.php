<?php

use app\models\books\BooksSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var BooksSearch $searchModel */
/* @var View $this */
/* @var ActiveDataProvider $dataProvider */

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="catalog-index">
    <?php Pjax::begin(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box_books_sort_choice">
        Сортировка:
        <select class="box_books_sort_choice box_books_sort_choiceSelect cursor" name="box_books_sort_choice"
                onchange="location = this.value;" style="">
            <?php
            $values = [
                'title' => 'по алфавиту',
                'authors' => 'по автору',
            ];
            $current = Yii::$app->request->get('sort');
            ?>
            <?php foreach ($values as $value => $label): ?>
                <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>"
                        <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
            <?php endforeach; ?>
    </div>
    <br>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>

    <?php Pjax::end(); ?>
</div>
