<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var vendor\istt\numberingplans\models\NetworkCodeSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="network-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'operator_id') ?>

    <?= $form->field($model, 'mnc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('np', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('np', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
