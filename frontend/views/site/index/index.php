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
    <?php if (!empty($newProducts)): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="text-center"><?= Yii::t('shop', 'Sale products'); ?></h3>
            </div>
            <div class="panel-body">
                <?= $this->render('_products', [
                    'products' => $newProducts
                ]) ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<section class="sale-products">
    <?php if(!empty($saleProducts)): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="text-center"><?= Yii::t('shop', 'Sale products'); ?></h3>
            </div>
            <div class="panel-body">
                <?= $this->render('_products', [
                    'products' => $saleProducts
                ]) ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<section class="popular-products">
    <?php if (!empty($popularProducts)): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="text-center"><?= Yii::t('shop', 'New products'); ?></h3>
            </div>
            <div class="panel-body">
                <?= $this->render('_products', [
                    'products' => $popularProducts
                ]) ?>
            </div>
        </div>
    <?php endif; ?>
</section>


<section class="news">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center"><?= Yii::t('articles', 'Last articles'); ?></h3>
        </div>
        <div class="panel-body">
            <?= LastArticles::widget([
                'count' => 4,
                'condition' => ['show' => true]
            ]) ?>
        </div>
    </div>
</section>