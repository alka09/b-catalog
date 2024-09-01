<?php

use app\models\books\BooksSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ListView;

/* @var BooksSearch $searchModel */
/* @var View $this */
/* @var ActiveDataProvider $dataProvider */

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;

$model = new BooksSearch();

?>
<div class="catalog-index">
    <h2>search</h2>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>
</div>