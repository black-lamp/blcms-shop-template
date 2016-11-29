<?php

/**
 * @var $this \yii\web\View
 */

use backend\assets\AppAsset;
use bl\multilang\entities\Language;
use yii\helpers\Html;
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

    <?php if(Yii::$app->user->can('accessAdminPanel')): ?>
        <?= $this->render('_navbar'); ?>
    <?php endif; ?>

    <div class="container">
        <?php if(Yii::$app->user->can('accessAdminPanel')): ?>
            <?= Breadcrumbs::widget([
                'class' => 'breadcrumb',
                'homeLink' => [
                    'label' => Yii::t('yii', 'Home'),
                    'url' => ['/'],
                    'itemprop' => 'url',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'activeItemTemplate' => '<li class="active"><strong>{link}</strong></li>'
            ]) ?>
        <?php endif; ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php if(Yii::$app->user->can('accessAdminPanel')): ?>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
<?php endif; ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
