<?php
namespace frontend\controllers;

use bl\articles\common\entities\Article;
use bl\cms\seo\StaticPageBehavior;
use bl\cms\shop\common\entities\Product;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 *
 * @method StaticPageBehavior registerStaticSeoData
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'staticPage' => [
                'class' => StaticPageBehavior::className(),
                'key' => 'main'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $newProducts = Product::find()
            ->where(['sale' => false])
            ->orderBy(['creation_time' => SORT_DESC])
            ->limit(8)
            ->all();

        $saleProducts = Product::find()
            ->where(['sale' => true])
            ->orderBy(['update_time' => SORT_DESC])
            ->limit(8)
            ->all();

        $popularProducts = Product::find()
            ->orderBy(['views' => SORT_DESC])
            ->limit(8)
            ->all();

        $newArticles = Article::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(3)
            ->all();

        $this->registerStaticSeoData();

        return $this->render('index/index', [
            'newProducts' => $newProducts,
            'saleProducts' => $saleProducts,
            'popularProducts' => $popularProducts,
            'newArticles' => $newArticles
        ]);
    }
}
