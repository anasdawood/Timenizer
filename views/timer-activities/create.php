<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TimerActivities */

$this->title = Yii::t('app', 'Create Timer Activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timer Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timer-activities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    

</div>
