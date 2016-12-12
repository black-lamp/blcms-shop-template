<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/',
    'bootstrap' => [
        'log',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'shop' => [
            'class' => bl\cms\shop\frontend\Module::className(),
            'partnerManagerEmail' => $params['partnerManagerEmail'],
            'senderEmail' => $params['infoEmail'],
            'showChildCategoriesProducts' => true,
        ],
        'cart' => [
            'class' => bl\cms\cart\frontend\Module::className(),
            'enableLog' => true,
        ],
        'payment' => [
            'class' => bl\cms\payment\frontend\Module::className(),
        ],
        'user' => [
            'class' => dektrium\user\Module::className(),
            'modelMap' => [
                'User' => bl\cms\cart\common\components\user\models\User::className(),
                'Profile' => bl\cms\cart\common\components\user\models\Profile::className(),
                'RegistrationForm' => bl\cms\cart\common\components\user\models\RegistrationForm::className(),
            ],
            'controllerMap' => [
                'registration' => bl\cms\cart\frontend\components\user\controllers\RegistrationController::className(),
                'settings' => bl\cms\cart\frontend\components\user\controllers\SettingsController::className(),
            ],
            'as frontend' => dektrium\user\filters\FrontendFilter::className(),
        ],
        'articles' => [
            'class' => bl\articles\frontend\Module::className()
        ],
        'gallery' => [
            'class' => bl\cms\gallery\frontend\Module::className(),
            'layoutPath' => '@frontend/views/layouts',
            'layout' => 'main'
        ],
        'nova-poshta' => [
            'class' => bl\cms\novaposhta\frontend\Module::className(),
            'apiKey' => $params['novaPoshtaApiKey']
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/',
            'csrfParam' => '_csrf-frontend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'class' => bl\locale\UrlManager::className(),
            'baseUrl' => '/',
            'showScriptName' => false,
            'detectInSession' => false,
            'detectInCookie' => false,
            'enablePrettyUrl' => true,
            'languageProvider' => [
                'class' => bl\locale\provider\DbLanguageProvider::className(),
                'db' => 'db',
                'table' => 'language',
                'localeField' => 'lang_id',
                'languageCondition' => ['active' => true],
            ],
            'lowerCase' => true,
            'useShortSyntax' => false,
            'languageKey' => 'language',
            'showDefault' => false,
            'rules' => [
                [
                    'class' => bl\articles\UrlRule::className(),
                    'prefix' => 'articles',
                ],
                [
                    'class' => bl\cms\shop\UrlRule::className(),
                    'prefix' => 'shop'
                ],
                [
                    'class' => bl\cms\gallery\components\UrlRule::className(),
                    'prefix' => 'gallery',
                    'disableDefault' => false
                ],
                [
                    'class' => bl\seo\UniqueUrlRule::class,
                    'destination' => 'cart',
                    'duplicate' => [
                        'cart/cart/show',
                        'cart/cart'
                    ]
                ],
            ]
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'username' => $params['infoEmail'],
                'password' => $params['infoEmailPassword'],
                'host' => $params['emailHost'],
                'port' => $params['emailPort'],
            ],
        ],
        'partnerMailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
            'viewPath' => '@bl/blcms-shop/frontend/views/partner-request/mail',
            'htmlLayout' => '@bl/blcms-shop/frontend/views/partner-request/mail/layout',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'username' => $params['infoEmail'],
                'password' => $params['infoEmailPassword'],
                'host' => $params['emailHost'],
                'port' => $params['emailPort'],
            ],
        ],
        'shopMailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
            ],
            'viewPath' => '@bl/blcms-cart/frontend/views/mail',
            'htmlLayout' => '@bl/blcms-cart/frontend/views/mail/layout',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'username' => $params['infoEmail'],
                'password' => $params['infoEmailPassword'],
                'host' => $params['emailHost'],
                'port' => $params['emailPort'],
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@frontend/themes/' . $params['themeName'],
                'baseUrl' => '@web/themes/' . $params['themeName'],
                'pathMap' => [
                    '@dektrium/user/views' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-shop/views/user',
                    '@frontend/views' => '@frontend/themes/' . $params['themeName'] . '/views',
                    '@bl/yii2-articles/frontend' => '@frontend/themes/' . $params['themeName'] . '/modules/yii2-articles',
                    '@bl/yii2-articles/common/widgets/views' => '@frontend/themes/' . $params['themeName'] . '/modules/yii2-articles/widgets/views',
                    '@bl/blcms-shop/frontend/views' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-shop/views',
                    '@bl/blcms-shop/widgets/views' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-shop/widgets/views',
                    '@bl/blcms-cart/frontend/views/cart' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-cart/views',
                    '@bl/blcms-cart/widgets/views' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-cart/widgets/views',
                    '@bl/blcms-gallery/frontend/views' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-gallery/views',
                    '@bl/blcms-payment/widgets/views' => '@frontend/themes/' . $params['themeName'] . '/modules/blcms-payment/widgets/views',
                    '@bl/yii2-newsletter/frontend/widgets/views' => '@frontend/themes/' . $params['themeName'] . '/modules/yii2-newsletter/widgets/views'
                ],
            ]
        ]
    ],
    'params' => $params,
];
