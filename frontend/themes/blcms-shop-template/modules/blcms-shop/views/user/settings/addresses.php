<?php
use yii\bootstrap\Html;
use yii\helpers\Url;

/**
 * @var \bl\cms\cart\common\components\user\models\UserAddress $addresses
 */

$this->title = Yii::t('shop', 'Addresses');
$this->params['breadcrumbs'][] = $this->title;
?>


<?php if (!empty($addresses)) : ?>
    <?= Html::a(\Yii::t('shop', 'Add new address'), Url::toRoute('save'), ['class' => 'btn btn-success']); ?>
    <table class="table table-hover">
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-9"><?= \Yii::t('shop', 'Addresses'); ?></th>
            <th class="col-md-2"><?= \Yii::t('shop', 'Manage'); ?></th>
        </tr>
        <?php foreach ($addresses as $address) : ?>
            <tr>
                <td><?= $address->id; ?></td>
                <td>
                    <p><?= "$address->zipcode $address->country, $address->region, $address->city "; ?></p>
                    <p><em><?= \Yii::t('shop', 'street') . " $address->street, $address->house" .
                            " - $address->apartment"; ?></em></p>
                </td>
                <td>
                    <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', Url::toRoute(['delete-address', 'id' => $address->id]),
                        ['title' => Yii::t('yii', 'Delete'), 'class' => 'btn btn-danger pull-right pjax']) .
                    Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::toRoute(['save-address', 'id' => $address->id]),
                        ['class' => 'btn btn-primary ']); ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <h3>
        <?= \Yii::t('shop', 'You have not added any address'); ?>
    </h3>
    <?= Html::a(\Yii::t('shop', 'Add new address'), Url::toRoute('save-address'), ['class' => 'btn btn-success']); ?>
<?php endif; ?>