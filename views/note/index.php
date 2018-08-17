<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="note-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Note'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //d($dataProvider); exit?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'text:raw',
            ['attribute' => 'Author',
                'value' => function (\app\models\Note $model) {
                    return Html::a($model->user->name . " " . $model->user->surname, ['/note/mynotes/']);
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} ',
                'visibleButtons' => [
                    //'delete' => false
                ],
            ]
        ],

    ]) ?>

</div>
