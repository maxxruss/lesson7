<?php

use yii\helpers\Html;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $viewModel User */


$this->title = Yii::t('app', 'Create Access');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accesses'), 'url' => ['/access/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'viewModel' => $viewModel,
    ]) ?>

</div>
