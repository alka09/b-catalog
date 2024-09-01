<?php

use app\models\books\Books;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var Books $model */

$authorLinks = [];
foreach ($model->authors as $author) {
$authorLinks[] = Html::a(Html::encode($author->surname), ['author', 'author' => $author->surname]);
}

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p>Книга: </p>
        <?= Html::img($model->getPhotoPath($model->photo), ['width' => 100, 'alt' => $model->title]); ?>
    </div>
    <div class="panel-heading">
        <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <p>Краткое описание: </p>
        <div>
            <?= Yii::$app->formatter->asNtext($model->description) ?>
        </div>
<?php if ($authorLinks): ?>
            <p>Авторы: <?= implode(', ', $authorLinks) ?></p>
        <?php endif; ?>
    </div>
</div>

