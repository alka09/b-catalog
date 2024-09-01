<?php

use app\models\authors\Authors;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var Authors $model */
/* @var $year */

$authors = (new Authors())->getAuthorsForReport($year);
$a=4;
?>

<?php foreach ($authors as $author):  ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p>blf</p>
        <?= Html::a(Html::encode($author->surname), ['view', 'id' => $model->id]) ?>
    </div>

</div>
<?php endforeach; ?>