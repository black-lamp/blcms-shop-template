<?php
use bl\cms\shop\widgets\ProductSort;
use yii\helpers\Url;
use yii\widgets\ListView;
use bl\cms\shop\common\entities\Category;
use bl\cms\shop\frontend\components\ProductSearch;

/**
 * @var Category $category
 * @var ProductSearch $dataProvider
 */

$shop = (!empty($category->translation->title)) ? [
    'label' => Yii::t('frontend/navigation', 'Магазин'),
    'url' => (!empty($category)) ? Url::toRoute(['/shop']) : false,
    'itemprop' => 'url',
] : Yii::t('frontend/navigation', 'Магазин');

$links = (!empty($category)) ? [$shop, $category->translation->title] : [$shop];
?>

<?php $image_path = (!empty($category)) ? Category::getBig($category, 'cover') : ''; ?>
<section class="page-image" style="background-image: url(<?= $image_path ?>); background-position:center;">
    <div class="image-filter"></div>
    <?php if (!empty($category)): ?>
        <?php if (!empty($category->translation->title)): ?>
            <h2 class="image-text">
                <?= $category->translation->title ?>
            </h2>
        <?php endif; ?>
    <?php endif; ?>
</section>

<div class="panel">
    <div class="panel-body">
<!--        <?//= ProductSort::widget(); ?> -->
    </div>
</div>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'panel',
        'id' => '',
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-xs-6 col-sm-4 col-md-3',
    ],
    'layout' => "{pager}\n{items}\n{pager}",
    'summary' => '{count} ' . Yii::t('shop', 'from') . ' {totalCount}',
    'summaryOptions' => [
        'tag' => 'span',
        'class' => ''
    ],
    'pager' => [
        'maxButtonCount' => 3,
    ],
    'emptyText' => Yii::t('shop', 'The list is empty'),
    'itemView' => '//_productItem',
]) ?>

<?php if(!empty($category->translation->description)): ?>
    <div class="category-description">
        <?php if(!empty($category->translation->title)): ?>
            <h2><?= $category->translation->title ?></h2>
        <?php endif; ?>
        <?= $category->translation->description ?>
    </div>
<?php endif; ?>
