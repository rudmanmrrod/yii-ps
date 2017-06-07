<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasswordsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Passwords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passwords-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Passwords', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pkpassword',
            'descripcion:ntext',
            //'password',
            'creado_en',
            'actualizado_en',
            // 'fkuser',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}{unlock}',
            'buttons' => [
                'unlock' => function($url,$model){
                        return Html::a(
                        '<span class="glyphicon glyphicon-lock"></span>',
                        ['unlock','id'=>$model->pkpassword],
                        [
                            'title'=> 'Desbloquear',
                        ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
