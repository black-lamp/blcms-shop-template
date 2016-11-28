<?php
use bl\articles\common\widgets\LastArticles;

use bl\cms\shop\common\entities\Product;

/**
 * @var yii\web\View $this
 * @var Product[] $newProducts
 * @var Product[] $saleProducts
 * @var Product[] $popularProducts
 */
?>

<section class="new-products">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($newProducts)): ?>
                <h2 class="text-center"><?= Yii::t('shop', 'Sale products'); ?></h2>
                <?= $this->render('_products', [
                'products' => $newProducts
            ]) ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="sale-products">
    <div class="row">
        <div class="col-md-12">
            <?php if(!empty($saleProducts)): ?>
                <h2 class="text-center"><?= Yii::t('shop', 'Sale products'); ?></h2>
                <?= $this->render('_products', [
                    'products' => $saleProducts
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="popular-products">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($popularProducts)): ?>
                <h2 class="text-center"><?= Yii::t('shop', 'New products'); ?></h2>
                <?= $this->render('_products', [
                    'products' => $popularProducts
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="news">
    <h2 class="text-center"><?= Yii::t('articles', 'Last articles'); ?></h2>
    <?= LastArticles::widget([
        'count' => 4,
        'condition' => ['show' => true]
    ]) ?>
</section>