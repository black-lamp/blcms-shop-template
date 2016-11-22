<?php
namespace common\components;

use Yii;
use yii\base\Behavior;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\User;

class AccessBehavior extends Behavior implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Event::on(User::className(), User::EVENT_BEFORE_LOGIN, [$this, 'beforeLogin']);
    }

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    public function beforeAction() {
        if (Yii::$app->getUser()->isGuest &&
            Yii::$app->getRequest()->url !== Url::toRoute(Yii::$app->getUser()->loginUrl))
        {
            Yii::$app->getResponse()->redirect(Url::toRoute(Yii::$app->getUser()->loginUrl));
        }
    }

    public function beforeLogin($event) {
        if (!Yii::$app->authManager->checkAccess($event->identity->id, 'accessAdminPanel')) {

            throw new ForbiddenHttpException('You can not view this page.');
        }
    }
}