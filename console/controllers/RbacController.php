<?php
namespace console\controllers;

use dektrium\user\models\User;
use nirvana\helpers\RbacHelper;
use Yii;
use yii\console\Controller;


/**
 * @author Vyacheslav Nozhenko <vv.nojenko@gmail.com>
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //region adminPanelManager
        $adminPanelManagerRole = RbacHelper::createRole('adminPanelManager', 'Admin panel manager');
        $auth->addChild($adminPanelManagerRole, $auth->getPermission('accessAdminPanel'));
        //endregion

        //region administrator
        $administratorRole = RbacHelper::createRole('administrator', 'Administrator');
        $auth->addChild($administratorRole, $adminPanelManagerRole);
        $auth->addChild($administratorRole, $auth->getRole('shopAdministrator'));
        $auth->addChild($administratorRole, $auth->getRole('articleAdministrator'));
        $auth->addChild($administratorRole, $auth->getRole('languageManager'));
        $auth->addChild($administratorRole, $auth->getRole('rbacManager'));
        $auth->addChild($administratorRole, $auth->getRole('staticPageManager'));
        $auth->addChild($administratorRole, $auth->getRole('vendorManager'));
        //endregion

        //region productPartner
        $auth->addChild($auth->getRole('productPartner'), $adminPanelManagerRole);
        //endregion

        //region Assign the roles
        $auth->assign($administratorRole, User::findOne(['username' => 'admin'])->id);
        //endregion
    }
}