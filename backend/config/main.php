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
//        'bl\cms\shop\backend\components\events\PartnersBootstrap',
        'bl\cms\shop\backend\components\events\ShopLogBootstrap',
        'bl\cms\cart\backend\components\events\CartBootstrap',
        'common\components\AccessBehavior'
    ],
    'modules' => [
        'languages' => [
            'class' => bl\cms\language\Module::className(),
        ],
        'redirect' => [
            'class' => bl\cms\redirect\Module::className()
        ],
        'rbac' => [
            'class' => bl\rbac\Module::className(),
        ],
        'seo' => [
            'class' => bl\cms\seo\backend\Module::className()
        ],
        'shop' => [
            'class' => bl\cms\shop\backend\Module::className(),
            'enableLog' => true,
        ],
        'cart' => [
            'class' => bl\cms\cart\backend\Module::className(),
            'enableLog' => true,
        ],
        'payment' => [
            'class' => bl\cms\payment\backend\Module::className(),
        ],
        'articles' => [
            'class' => bl\articles\backend\Module::className()
        ],
        'gallery' => [
            'class' => bl\cms\gallery\backend\Module::className(),
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
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/admin',
            ],
        ],
        /*
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        */
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
                    '@dektrium/user/views' => '@vendor/black-lamp/blcms-shop/backend/views/user',
                ],
            ],
        ],
    ],
    'as AccessBehavior' => [
        'class' => common\components\AccessBehavior::className()
    ],
    'params' => $params,
];
