<?php
namespace console\controllers;

use dektrium\user\models\User;
use nirvana\helpers\RbacHelper;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\rbac\Role;


/**
 * @author Vyacheslav Nozhenko <vv.nojenko@gmail.com>
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //region adminPanelManager
        $adminPanelManagerRole = $this->createRole('adminPanelManager', 'Admin panel manager');
        $this->addChild($adminPanelManagerRole, $auth->getPermission('accessAdminPanel'));
        //endregion

        //region administrator
        $administratorRole = $this->createRole('administrator', 'Administrator');
        $this->addChild($administratorRole, $adminPanelManagerRole);
        $this->addChild($administratorRole, $auth->getRole('shopAdministrator'));
        $this->addChild($administratorRole, $auth->getRole('articleAdministrator'));
        $this->addChild($administratorRole, $auth->getRole('languageManager'));
        $this->addChild($administratorRole, $auth->getRole('rbacManager'));
        $this->addChild($administratorRole, $auth->getRole('staticPageManager'));
        $this->addChild($administratorRole, $auth->getRole('vendorManager'));
        $this->addChild($administratorRole, $auth->getRole('moderationManager'));
        //endregion

        //region productPartner
        $this->addChild($auth->getRole('productPartner'), $adminPanelManagerRole);
        //endregion

        //region Assign the roles
        $this->assign($administratorRole, 'admin');
        //endregion
    }

    /**
     * @param \yii\rbac\Item $parent
     * @param \yii\rbac\Item $child
     * @return bool
     */
    private function addChild($parent, $child)
    {
        $auth = Yii::$app->authManager;

        if (!$auth->hasChild($parent, $child)) {
            $auth->addChild($parent, $child);
            $this->stdout("\t'{$child->name}' item added to '{$parent->name}' item. \n", Console::FG_GREY);
        }
        else {
            $this->stderr("\t'{$child->name}' item already added to '{$parent->name}' item. \n", Console::FG_RED);

            return false;
        }

        return true;
    }

    /**
     * @param $name
     * @param $description
     * @return \yii\rbac\Role
     */
    private function createRole($name, $description)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);

        if (empty($role)) {
            $role = $auth->createRole($name);
            $role->description = $description;
            $auth->add($role);

            $this->stdout("\tCreated '{$name}' role. \n", Console::FG_GREY);
        }
        else {
            $this->stderr("\t'{$name}' role is exist. \n", Console::FG_RED);
        }

        return $role;
    }

    /**
     * @param \yii\rbac\Role $role
     * @param string $username
     * @return null|\yii\rbac\Assignment|Role
     */
    private function assign($role, $username) {

        $auth = Yii::$app->authManager;
        $user = User::findOne(['username' => $username]);
        $assignment = $auth->getAssignment($role->name, $user->id);

        if (empty($assignment)) {
            $auth->assign($role, $user->id);
            $this->stdout("\tAssigns a '{$role->name}' role to a '{$username}' user. \n", Console::FG_GREY);
        }
        else {
            $this->stderr("\t'{$role->name}' role is already assigned to a '{$username}' user. \n", Console::FG_RED);
        }

        return $assignment;
    }
}