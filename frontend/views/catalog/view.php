<?php

use app\models\books\Books;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var View $this */
/* @var Books $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'label' => 'Authors',
                        'value' => implode(', ', ArrayHelper::map($model->authors, 'id', 'name')),
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($model->description) ?>
        </div>
    </div>
</div>

