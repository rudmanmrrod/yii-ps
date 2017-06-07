<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Passwords */

$this->title = 'Create Passwords';
$this->params['breadcrumbs'][] = ['label' => 'Passwords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passwords-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
