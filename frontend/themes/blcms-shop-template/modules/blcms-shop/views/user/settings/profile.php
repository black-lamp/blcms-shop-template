<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'profile-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                'labelOptions' => ['class' => 'col-lg-3 control-label'],
            ],
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
        ]); ?>

        <?= $form->field($model, 'name')->label(Yii::t('user', 'Name')) ?>
        <?= $form->field($model, 'surname')->label(Yii::t('user', 'Surname')) ?>
        <?= $form->field($model, 'patronymic')->label(Yii::t('user', 'Patronymic')) ?>
        <?= $form->field($model, 'phone')
            ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(999)-999-99-99'])->label(Yii::t('user', 'Phone')); ?>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <?= \yii\helpers\Html::submitButton(
                    Yii::t('user', 'Save'),
                    ['class' => 'btn btn-block btn-success']
                ) ?><br>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

