<?php
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'BLCMS Shop Template',

    'language' => 'ru',
    'sourceLanguage' => 'en-us',

    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@bl' => '@vendor/black-lamp',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'logTable' => 'error_log',
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error'],
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\web\HttpException:400',
                        'yii\i18n\PhpMessageSource::loadMessages'
                    ],
                ],
                [
                    'logTable' => 'shop_log',
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['info'],
                    'logVars' => [],
                    'categories' => [
                        'afterCreateProduct', 'afterDeleteProduct', 'afterEditProduct',
                        'afterCreateCategory', 'afterEditCategory', 'afterDeleteCategory',
                    ],
                ],
                [
                    'logTable' => 'cart_log',
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['info'],
                    'logVars' => [],
                    'categories' => [
                        'afterChangeOrderStatus'
                    ],
                ],
                [
                    'logTable' => 'user_log',
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['info'],
                    'logVars' => [],
                    'categories' => [
                        'afterRegister', 'afterConfirm'
                    ],
                ],
            ],
        ],
        'cache' => [
            'class' => yii\caching\FileCache::className(),
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::className(),
        ],
        'formatter' => [
            'class' => yii\i18n\Formatter::className(),
            'timeZone' => 'UTC',
            'nullDisplay' => '',
            /*
            'numberFormatterSymbols' => [
                NumberFormatter::CURRENCY_SYMBOL => 'грн',
            ]
            */
        ],
        'cart' => [
            'class' => bl\cms\cart\CartComponent::className(),
            'emailNotifications' => true,
            'sender' => $params['senderEmail'],
            'sendTo' => [
                $params['orderManagerEmail']
            ],
            'saveToDataBase' => true,
            'enablePayment' => true,
        ],
        'i18n' => [
            'class'      => uran1980\yii\modules\i18n\components\I18N::className(),
            'languages'  => ['ru', 'uk-ua'],
            'format'     => 'db',
            'sourcePath' => [
                __DIR__ . '/../../frontend',
                __DIR__ . '/../../backend',
                __DIR__ . '/../../common',
            ],
            'messagePath' => __DIR__  . '/../../messages',
            'translations' => [
                '*' => [
                    'class'           => yii\i18n\DbMessageSource::className(),
                    'sourceLanguage' => 'en-us',
                    'enableCaching'   => false,
//                    'cachingDuration' => 60 * 60 * 2, // cache on 2 hours
                ],
            ],
        ],
        'shop_imagable' => [
            'class' => bl\imagable\Imagable::className(),
            'imageClass' => \bl\imagable\instances\CreateImageImagine::className(),
            'nameClass' => bl\imagable\name\CRC32Name::className(),
            'imagesPath' => '@frontend/web/images',
            'categories' => [
                'origin' => false,
                'category' => [
                    'shop-product' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 800
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 250,
                                'height' => 250
                            ]
                        ]
                    ],
                    'shop-vendors' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 320,
                                'height' => 240,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                    'delivery' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                    'cover' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                    'thumbnail' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                    'menu_item' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'articles_imagable' => [
            'class' => bl\imagable\Imagable::className(),
            'imageClass' => \bl\imagable\instances\CreateImageImagine::className(),
            'nameClass' => bl\imagable\name\CRC32Name::className(),
            'imagesPath' => '@frontend/web/images',
            'categories' => [
                'origin' => false,
                'category' => [
                    'thumbnail' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                    'menu_item' => [
                        'origin' => false,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                    'social' => [
                        'origin' => true,
                        'size' => [
                            'big' => [
                                'width' => 1500,
                                'height' => 500
                            ],
                            'thumb' => [
                                'width' => 500,
                                'height' => 500,
                            ],
                            'small' => [
                                'width' => 150,
                                'height' => 150
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ],
];
