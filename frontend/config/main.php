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
    'bootstrap' => [
        'log',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'articles' => [
            'class' => bl\articles\frontend\Module::className()
        ],
        'shop' => [
            'class' => bl\cms\shop\frontend\Module::className(),
            'partnerManagerEmail' => $params['partnerManagerEmail'],
            'senderEmail' => $params['infoEmail']
        ],
        'cart' => [
            'class' => bl\cms\cart\frontend\Module::className(),
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
                'registration' => bl\cms\cart\common\components\user\controllers\RegistrationController::className(),
                'settings' => bl\cms\cart\frontend\components\user\controllers\SettingsController::className(),
            ],
            'as frontend' => dektrium\user\filters\FrontendFilter::className(),
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
        'user' => [
            'identityClass' => common\models\User::className(),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'viewPath' => '@vendor/black-lamp/blcms-shop/frontend/views/partner-request/mail',
            'htmlLayout' => '@vendor/black-lamp/blcms-shop/frontend/views/partner-request/mail/layout',
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
            'viewPath' => '@vendor/black-lamp/blcms-cart/frontend/views/mail',
            'htmlLayout' => '@vendor/black-lamp/blcms-cart/frontend/views/mail/layout',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'username' => $params['infoEmail'],
                'password' => $params['infoEmailPassword'],
                'host' => $params['emailHost'],
                'port' => $params['emailPort'],
            ],
        ],
    ],
    'params' => $params,
];
