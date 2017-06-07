<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Passwords */

$this->title = 'Update Passwords: ' . $model->pkpassword;
$this->params['breadcrumbs'][] = ['label' => 'Passwords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkpassword, 'url' => ['view', 'id' => $model->pkpassword]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="passwords-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
