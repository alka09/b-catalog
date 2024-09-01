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

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>

    <?php Pjax::end(); ?>
</div>
