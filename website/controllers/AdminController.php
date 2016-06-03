<?php
namespace website\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use common\models\UserSearch;
use common\models\RoleSearch;
use website\models\admin\CreateUserForm;
use website\models\admin\CreateRoleForm;
use GLS\Audit\models\LogSearch;
use GLS\Audit\Logger;

/**
 * Site controller
 */
class AdminController extends Controller
{

    public function actionUsers()
    {
        if (!Yii::$app->user->can('manageUsers')) return $this->goHome();

        $searchModel = new UserSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->pagination->pageSize = 20;
        $dataProvider->sort->defaultOrder = ['username' => SORT_ASC];

        return $this->render('users', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionLogs()
    {
        if (!Yii::$app->user->can('manageUsers')) return $this->goHome();

        $searchModel = new LogSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->pagination->pageSize = 20;
        $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];

        return $this->render('logs', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreateUser()
    {
        $model = new CreateUserForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->createUser()) {
            Yii::$app->getSession()->setFlash('success', 'User created.');

            return $this->goBack('users');
        }

        return $this->render('createUser', [
            'model' => $model,
        ]);
    }

    public function actionEditUser($id)
    {
        if (array_key_exists('manageSystem', \Yii::$app->authManager->getPermissionsByUser($id)) && !Yii::$app->user->can('manageSystem')) {
            Yii::$app->getSession()->setFlash('danger', 'Permission Denied.');
            return $this->goBack('users');
        }
        $user = User::findOne($id);

        if ($user->load(Yii::$app->request->post()) && $user->validate() && $user->save()) {
            Yii::$app->getSession()->setFlash('success', 'User updated.');

            return $this->goBack('users');
        }

        return $this->render('editUser', ['model' => $user, 'userId' => $id]);
    }

    public function actionToggleActiveUser($id)
    {
        if (array_key_exists('manageSystem', \Yii::$app->authManager->getPermissionsByUser($id)) && !Yii::$app->user->can('manageSystem')) {
            Yii::$app->getSession()->setFlash('danger', 'Permission Denied.');
            return $this->goBack('users');
        }

        $user = User::findOne($id);

        if ($user->status == User::STATUS_DELETED) {
            Yii::$app->getSession()->setFlash('success', 'User Enabled.');
            Logger::log(sprintf("Enabled user %s.", $user->username), Logger::LOG_USERS, Logger::LOG_INFO);
        } else {
            Yii::$app->getSession()->setFlash('success', 'User Disabled.');
            Logger::log(sprintf("Disabled user %s.", $user->username), Logger::LOG_USERS, Logger::LOG_INFO);
        }
        $user->status = ($user->status == User::STATUS_DELETED ? User::STATUS_ACTIVE : User::STATUS_DELETED);
        $user->save();

        if (Yii::$app->getRequest()->isAjax) {
            $searchModel = new UserSearch();

            $dataProvider = $searchModel->search([]);
            $dataProvider->pagination->pageSize = 20;
            $dataProvider->sort->defaultOrder = ['username' => SORT_ASC];

            return $this->renderPartial('users', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }

        return $this->redirect(['users']);
    }

    public function actionResetUser($id)
    {

    }

    public function actionAddUserRole($id, $role) {
        $user = User::findOne($id);

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($role);

        Logger::log(sprintf("Role %s added to user %s.", $role->name, $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
        $auth->assign($role, $user->getId());

        Yii::$app->getSession()->setFlash('success', 'Role Added.');
        return $this->redirect(['edit-user', 'model' => $user, 'id' => $id]);
    }

    public function actionRemoveUserRole($id, $role) {
        $user = User::findOne($id);

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($role);

        Logger::log(sprintf("Role %s removed from user %s.", $role->name, $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
        $auth->revoke($role, $user->getId());

        Yii::$app->getSession()->setFlash('success', 'Role Removed.');
        return $this->redirect(['edit-user', 'model' => $user, 'id' => $id]);
    }

    public function actionRoles()
    {
        if (!Yii::$app->user->can('manageSystem')) return $this->goHome();

        $searchModel = new RoleSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->pagination->pageSize = 20;
        $dataProvider->sort->defaultOrder = ['name' => SORT_ASC];

        return $this->render('roles', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCreateRole()
    {
        $model = new CreateRoleForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->createRole()) {
            Yii::$app->getSession()->setFlash('success', 'Role created.');

            return $this->goBack('roles');
        }

        return $this->render('createRole', [
            'model' => $model,
        ]);
    }

    public function actionRemoveRole($name)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);

        if (!$role || !$auth->remove($role)) {
            Yii::$app->getSession()->setFlash('danger', 'Unable to remove role.');

            return $this->goBack('roles');
        }

        Yii::$app->getSession()->setFlash('success', 'Role removed.');

        return $this->goBack('roles');
    }

    public function actionEditRole($name)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);

        if (Yii::$app->request->post()) {
            $newRole = $auth->createRole(Yii::$app->request->post()['Role']['name']);
            $newRole->description =  Yii::$app->request->post()['Role']['description'];

            $auth->update($role->name, $newRole);

            Yii::$app->getSession()->setFlash('success', 'Role updated.');

            return $this->goBack('roles');
        }

        return $this->render('editRole', ['role' => $role]);
    }
}
