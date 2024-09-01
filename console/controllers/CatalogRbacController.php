<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Инициализатор RBAC выполняется в консоли php yii my-rbac/init
 */
class CatalogRbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $catalogUser = $auth->createRole('catalogUser');
        $quest = $auth->createRole('quest');

        $auth->add($catalogUser);
        $auth->add($quest);

        $subscriptionBookAuthor = $auth->createPermission('subscriptionBookAuthor');
        $subscriptionBookAuthor->description = 'Подписка на новые книги автора';

        $updateRecord = $auth->createPermission('updateRecord');
        $updateRecord->description = 'Редактирование записи';

        $auth->add($subscriptionBookAuthor);
        $auth->add($updateRecord);

        $auth->addChild($quest, $subscriptionBookAuthor);
        $auth->addChild($catalogUser, $updateRecord);

        $auth->assign($catalogUser, 1);
        $auth->assign($quest, 2);
    }
}

