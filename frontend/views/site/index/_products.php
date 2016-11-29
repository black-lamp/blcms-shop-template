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
    <div class="col-xs-6 col-sm-4 col-md-3">
        <?= $this->render('//_productItem', [
            'model' => $product
        ]); ?>
    </div>
<?php endforeach; ?>