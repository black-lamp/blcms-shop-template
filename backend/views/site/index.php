<?php

/** 
 * @var $this yii\web\View
 */

use bl\articles\common\widgets\LastArticles;
use bl\cms\cart\widgets\NewOrders;
use bl\cms\shop\widgets\NewProducts;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?= Url::to(['/shop/product']) ?>">
                    <h3 class="panel-title"><?= Yii::t('backend', 'Last products') ?></h3>
                </a>
            </div>
            <div class="panel-body">
                <?= NewProducts::widget([
                    'num' => 15,
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?= Url::to(['/shop/product']) ?>">
                    <h3 class="panel-title"><?= Yii::t('backend', 'Last orders') ?></h3>
                </a>
            </div>
            <div class="panel-body">
                <?= NewOrders::widget([
                    'num' => 15,
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?= Url::to(['/shop/product']) ?>">
                    <h3 class="panel-title"><?= Yii::t('backend', 'Last articles') ?></h3>
                </a>
            </div>
            <div class="panel-body">
                <?= LastArticles::widget([
                    'count' => 15,
                ]) ?>
            </div>
        </div>
    </div>
</div>