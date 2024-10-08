<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\authors\Authors $model */

$this->title = 'Create Authors';
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
