<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var bl\cms\cart\CartComponent $cart
 */

$cart = Yii::$app->cart;

?>
<div class="well well-sm">
    <div class="row">
        <div class="col-md-6">
            <?php $searchForm = ActiveForm::begin([
                'method' => 'get',
                'action' => ['/search'],
                'options' => [
                    'class' => 'inline-form',
                ]
            ]) ?>
            <?= Html::input('text', 'query', '', [
                'class' => 'form-control',
                'placeholder' => Yii::t('frontend', 'Search') . '...'
            ]) ?>
            <?php $searchForm->end() ?>
        </div>
        <div class="col-md-5">
            <div class="col-md-5 pull-right">
                <?php $url = Url::toRoute('/shop/favorite-product/list') ?>
                <a href="<?= $url ?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-star"></i>
                </a>
                <a href="<?= Url::toRoute('/cart') ?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                    <span><?= Yii::$app->formatter->asCurrency($cart->getTotalCost()); ?></span>
                    <?php if($cart->getOrderItemsCount() != 0): ?>
                        <span class="label label-info"><?= $cart->getOrderItemsCount() ?></span>
                    <?php endif ?>
                </a>
            </div>
        </div>
        <div class="col-md-1">
            <div class="dropdown">
                <button id="user-menu" class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i>
                </button>
                <ul class="dropdown-menu pull-right" aria-labelledby="user-menu">
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <p>
                            <?= Yii::$app->user->identity->profile->name ?>
                            <?= Yii::$app->user->identity->profile->surname ?>
                        </p>
                        <li class="divider" role="separator"></li>
                    <?php endif; ?>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <li>
                            <?= Html::a(Yii::t('frontend', 'Order list'), Url::toRoute('/cart/order/show-order-list')) ?>
                        </li>
                    <?php endif; ?>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <li>
                            <?= Html::a(Yii::t('frontend', 'Viewed products'), Url::toRoute('/shop/viewed-product/list')) ?>
                        </li>
                    <?php endif; ?>
                    <li>
                        <?= Html::a(Yii::t('frontend', 'Profile'), Url::toRoute('/user/settings')) ?>
                    </li>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <li>
                            <?= Html::a(Yii::t('frontend', 'Addresses'), Url::toRoute('/user/settings/addresses')) ?>
                        </li>
                    <?php endif; ?>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <li>
                            <?= Html::a(Yii::t('frontend', 'Account'), Url::toRoute('/user/settings/account')) ?>
                        </li>
                    <?php endif; ?>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <li>
                            <?= Html::a(Yii::t('frontend', 'Social networks'), Url::toRoute('/user/settings/networks')) ?>
                        </li>
                    <?php endif; ?>
                    <?php if(!Yii::$app->user->isGuest): ?>
                        <li>
                            <?php ActiveForm::begin([
                                'action' => ['/user/security/logout']
                            ]) ?>
                            <button type="submit" class="btn btn-primary center-block"><?= Yii::t('auth', 'Logout'); ?></button>
                            <?php ActiveForm::end() ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
