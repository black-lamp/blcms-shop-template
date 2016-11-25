<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/admin',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
        'log',
        'bl\cms\shop\backend\components\events\PartnersBootstrap',
        'common\components\AccessBehavior'
    ],
    'modules' => [
        'articles' => [
            'class' => bl\articles\backend\Module::className()
        ],
        'languages' => [
            'class' => bl\cms\language\Module::className(),
        ],
        'redirect' => [
            'class' => bl\cms\redirect\Module::className()
        ],
        'shop' => [
            'class' => bl\cms\shop\backend\Module::className(),
        ],
        'gallery' => [
            'class' => bl\cms\gallery\backend\Module::className(),
        ],
        'cart' => [
            'class' => bl\cms\cart\backend\Module::className(),
        ],
        'payment' => [
            'class' => bl\cms\payment\backend\Module::className(),
        ],
        'rbac' => [
            'class' => bl\rbac\Module::className(),
        ],
        'seo' => [
            'class' => bl\cms\seo\backend\Module::className()
        ],
        'user' => [
            'class' => dektrium\user\Module::className(),
            'enableRegistration' => false,
            'enableConfirmation' => false,
            'admins' => ['admin'],
            'adminPermission' => 'rbacManager',
            'modelMap' => [
                'Profile' => bl\cms\cart\common\components\user\models\Profile::className(),
            ],
            'as backend' => [
                'class' => dektrium\user\filters\BackendFilter::className(),
                'only' => ['register'], // Block View Register Backend
            ],
        ],
        'i18n' => [
            'class' => uran1980\yii\modules\i18n\Module::className(),
            'controllerMap' => [
                'default' => uran1980\yii\modules\i18n\controllers\DefaultController::className(),
            ],
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => dektrium\user\models\User::className(),
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/admin',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => bl\multilang\MultiLangUrlManager::className(),
            'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'urlManagerFrontend' => [
            'class' => bl\multilang\MultiLangUrlManager::className(),
            'baseUrl' => '/',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'enableDefaultLanguageUrlCode' => false,
            'rules' => [
                [
                    'class' => bl\articles\UrlRule::className()
                ],
                [
                    'class' => bl\cms\shop\UrlRule::className(),
                    'prefix' => 'shop'
                ],
            ]
        ],
        'view' => [
            'theme' => [
                'basePath' => '@backend/themes/' . $params['themeName'],
                'baseUrl' => '@web/themes/' . $params['themeName'],
                'pathMap' => [
                    '@bl/blcms-shop/backend/views' => '@vendor/GutsVadim/blcms-itpl/modules/blcms-shop/views',
                    '@bl/blcms-cart/backend/views' => '@vendor/GutsVadim/blcms-itpl/modules/blcms-cart/views',
                    '@bl/blcms-staticpage/backend/views' => '@vendor/GutsVadim/blcms-itpl/modules/blcms-staticpage/views',
                    '@bl/blcms-payment/backend/views' => '@vendor/GutsVadim/blcms-itpl/modules/blcms-payment/views',
                    '@dektrium/user/views' => '@vendor/black-lamp/blcms-shop/backend/views/user',
                    '@vendor/uran1980/yii2-translate-panel/views/default' => '@vendor/GutsVadim/blcms-itpl/modules/yii2-translate-panel/views/default'
                ],
            ],
        ],
    ],
    'as AccessBehavior' => [
        'class' => common\components\AccessBehavior::className()
    ],
    'params' => $params,
];
