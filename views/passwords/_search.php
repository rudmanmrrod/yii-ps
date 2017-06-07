<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PasswordsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passwords-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pkpassword') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'creado_en') ?>

    <?= $form->field($model, 'actualizado_en') ?>

    <?php // echo $form->field($model, 'fkuser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
