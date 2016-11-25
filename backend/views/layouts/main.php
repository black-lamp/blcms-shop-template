<?php

/**
 * @var $this \yii\web\View
 */

use backend\assets\AppAsset;
use bl\multilang\entities\Language;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$currentLanguage = Language::getCurrent();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('yii', 'Home'), 'url' => ['/site/index']],
        [
            'label' => Yii::t('menu', 'Catalog'),
            'items' => [
                ['label' => Yii::t('menu', 'Categories'), 'url' => ['/shop/category']],
                ['label' => Yii::t('menu', 'Products'), 'url' => ['/shop/product']],
                ['label' => Yii::t('menu', 'Countries'), 'url' => ['/shop/country']],
                ['label' => Yii::t('menu', 'Vendors'), 'url' => ['/shop/vendor']],
                ['label' => Yii::t('menu', 'Attributes'), 'url' => ['/shop/attribute']],
                ['label' => Yii::t('menu', 'Availability statuses'), 'url' => ['/shop/product-availability']],
                ['label' => Yii::t('menu', 'Filters'), 'url' => ['/shop/filter']],
                ['label' => Yii::t('menu', 'Currency'), 'url' => ['/shop/currency']],
                ['label' => Yii::t('menu', 'Partners'), 'url' => ['/shop/partners']],
                ['label' => Yii::t('menu', 'Add product'), 'url' => ['/shop/product/save', 'languageId' => Language::getCurrent()->id]],
            ],
        ],
        [
            'label' => Yii::t('menu', 'Orders'),
            'items' => [
                ['label' => Yii::t('menu', 'Cart page'), 'url' => ['/seo/static/save-page', 'page_key' => 'cart', 'languageId' => $currentLanguage->id]],
                ['label' => Yii::t('menu', 'Order list'), 'url' => ['/shop/order']],
                ['label' => Yii::t('menu', 'Order statuses'), 'url' => ['/cart/order-status']],
                ['label' => Yii::t('menu', 'Delivery methods'), 'url' => ['/cart/delivery-method']],
                ['label' => Yii::t('menu', 'Payment methods'), 'url' => ['/payment']],
                ['label' => Yii::t('menu', 'Clients'), 'url' => ['/newsletter']],
            ],
        ],
        [
            'label' => Yii::t('menu', 'Gallery'),
            'items' => [
                ['label' => Yii::t('menu', 'Main page'), 'url' => ['/seo/static/save-page', 'page_key' => 'gallery', 'languageId' => $currentLanguage->id]],
                ['label' => Yii::t('menu', 'Albums'), 'url' => ['/gallery/album']],
                ['label' => Yii::t('menu', 'Photos'), 'url' => ['/gallery/image']],
                ['label' => Yii::t('menu', 'Add new'), 'url' => ['/gallery/image/create']],
            ],
        ],
        [
            'label' => Yii::t('menu', 'Articles'),
            'items' => [
                ['label' => Yii::t('menu', 'Articles list'), 'url' => ['/articles/article']],
                ['label' => Yii::t('menu', 'Categories'), 'url' => ['/articles/category']],
            ],
        ],
        ['label' => Yii::t('menu', 'Static pages'), 'url' => ['/seo/static']],
        ['label' => Yii::t('menu', 'Translations'), 'url' => ['/translations']],
        [
            'label' => Yii::t('menu', 'Users'),
            'items' => [
                ['label' => Yii::t('menu', 'User management'), 'url' => ['/user/admin']],
                ['label' => Yii::t('menu', 'User permissions'), 'url' => ['/rbac']],
            ]
        ],
        [
            'label' => Yii::t('menu', 'Settings'),
            'items' => [
                ['label' => Yii::t('menu', 'My account'), 'url' => ['/user/settings']],
                ['label' => Yii::t('menu', 'Languages'), 'url' => ['/languages']],
                ['label' => Yii::t('menu', 'Redirects'), 'url' => ['/redirect']],
            ]
        ],
    ];

    $menuItems[] = [
        'label' => 'Login', 'url' => ['/site/login'],
        'items' => [
            Html::beginForm(['/site/logout'], 'post')

            . Html::submitButton(
                Html::tag('i', '', ['class' => 'glyphicon glyphicon-log-out'])
                . \Yii::t('navigation', 'Logout'),
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
        ]
    ];


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
