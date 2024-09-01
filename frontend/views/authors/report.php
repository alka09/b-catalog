<?php

use app\models\authors\Authors;
use app\models\authors\AuthorsSearch;
use app\models\books\Books;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var AuthorsSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-report">

    <h1>Отчет по авторам</h1>

    <div class="box_products_sort_choice">

        <select class="box_products_sort_choice box_products_sort_choiceSelect cursor" name="box_products_sort_choice"
                onchange="location = this.value;" style="">
            <?php
            $years = (new Books())->find()->select(['year_of_issue'])->distinct()->asArray()->all();

            $values = [];
            array_walk_recursive($years, function ($item, $key) use (&$values) {
                $values[] = $item;
            });

            $current = Yii::$app->request->get('sort');
            ?>
            <?php foreach ($values as $value => $label): ?>
                <option value="<?= Html::encode(Url::current(['sort' => $label ?: null])) ?>"
                        <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <br>

    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
        'viewParams' => [
            'year' => $current
        ]
    ]); ?>

    <?php Pjax::end(); ?>

</div>