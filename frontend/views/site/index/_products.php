<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bl\cms\shop\common\entities\Product;
use bl\cms\cart\models\CartForm;

/**
 * @var \yii\web\View $this
 * @var Product[] $products
 */
?>
<?php foreach ($products as $product): ?>
    <?php $productUrl = Url::to([
        '/shop/product/show',
        'id' => $product->id
    ]);
    ?>
    <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="thumbnail">
            <a href="<?= $productUrl ?>">
                <img src="<?= $product->image->small ?>" alt="">
            </a>
            <div class="caption">
                <a href="<?= $productUrl ?>">
                    <h3><?= $product->translation->title ?></h3>
                </a>
                <a href="<?= $productUrl ?>">
                    <p><?= $product->translation->description ?></p>
                </a>
                <div class="buttons">
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
                            ->hiddenInput(['value' => $product->id])
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

                    <?php if(!Yii::$app->user->isGuest && !$product->isFavorite()): ?>
                        <?php $addFavoriteProductUrl = Url::to(['/shop/favorite-product/add', 'productId' => $product->id]); ?>
                        <a href="<?= $addFavoriteProductUrl ?>" class="btn btn-sm btn-warning pull-right">
                            <i class="glyphicon glyphicon-star"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>