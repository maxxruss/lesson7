<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\objects\ViewModels\NoteCreateView;
use kartik\widgets\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Note */
/* @var $viewModel NoteCreateView */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-form">

    <?php $form = ActiveForm::begin();
    //d($viewModel);exit;?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'users')->widget(Select2::class, [
        'data' => $viewModel->getUserOptions(),
        'options' => [
            'multiple' => true,
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
