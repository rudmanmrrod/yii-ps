<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Passwords */

$this->title = "Unlock";
$this->params['breadcrumbs'][] = ['label' => 'Passwords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

    <h1><?= Html::encode($this->title) ?></h1>

    <h3><?= $title ?></h3><br>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
    if($pass!='')
    {

?>
        <div class="panel panel-success">
            <div class="panel-heading">
                Su Contraseña Es:
            </div>
            <div class="panel-body">
                <?= $pass ?>
            </div>
        </div>
<?php
    }
?>