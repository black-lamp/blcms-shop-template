<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var \bl\cms\cart\common\components\user\models\UserAddress $address
 */

?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($address, 'country') ?>
<?= $form->field($address, 'region') ?>
<?= $form->field($address, 'city') ?>
<?= $form->field($address, 'street') ?>
<?= $form->field($address, 'house') ?>
<?= $form->field($address, 'apartment') ?>
<?= $form->field($address, 'zipcode') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>