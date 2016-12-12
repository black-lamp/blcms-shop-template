<?php
use bl\cms\cart\models\CartForm;
use bl\cms\shop\common\entities\Product;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var Product $model
 */

$productUrl = Url::to(['/shop/product/show',
    'id' => $model->id
]);
?>

<div class="thumbnail">
    <a href="<?= $productUrl ?>">
        <?php if (!empty($model->image)): ?>
            <img src="<?= $model->image->small ?>" alt="">
        <?php endif ?>
    </a>
    <div class="caption">
        <a href="<?= $productUrl ?>">
            <h3><?= $model->translation->title ?></h3>
        </a>
        <a href="<?= $productUrl ?>">
            <p><?= $model->translation->description ?></p>
        </a>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'action' => ['/cart/cart/add'],
                    'options' => [
                        'class' => 'col-md-6 row'
                    ]]);
                $cart = new CartForm();
                ?>
                <?= $form->field($cart, 'productId', [
                    'template' => '{input}',
                    'options' => []
                ])
                    ->hiddenInput(['value' => $model->id])
                    ->label(false) ?>

                <?= $form->field($cart, 'count', [
                    'template' => '{input}',
                    'options' => []
                ])
                    ->hiddenInput(['value' => 1])
                    ->label(false) ?>

                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                    <?= Yii::t('shop', 'Add to cart'); ?>
                </button>
                <?php $form->end() ?>

                <?php if (!Yii::$app->user->isGuest && !$model->isFavorite()): ?>
                    <?php $addFavoriteProductUrl = Url::to(['/shop/favorite-product/add', 'productId' => $model->id]); ?>
                    <a href="<?= $addFavoriteProductUrl ?>" class="btn btn-sm btn-warning pull-right">
                        <i class="glyphicon glyphicon-star"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>