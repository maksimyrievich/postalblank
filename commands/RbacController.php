<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 05.11.2017
 * Time: 23:24
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Rbac;


/**
 * Class RBAC Generator
 */
class RbacController extends Controller
{
    /**
     * Generates roles
     */
    public function actionInit()
    {

        $auth = Yii::$app->getAuthManager();    //Получаем экземпляр Аутменеджера
        $auth->removeAll(); //Удаляем из него всю информацию

        $adminPanel = $auth->createPermission(Rbac::PERMISSION_ADMIN_PANEL);    //Создаем разрешение
        $adminPanel->description = 'Admin panel';   //Присваиваем имя разрешению
        $auth->add($adminPanel);    //Добавляем в наш экземпляр аутменеджера разрешение "adminPanel"

        $user = $auth->createRole('user');  //Создаем роль юзера
        $user->description = 'User';    //Присваиваем имя роли
        $auth->add($user);  //Добавляем в наш экземпляр аутменеджера роль юзера

        $admin = $auth->createRole('admin');    //Создаем роль админа
        $admin->description = 'Admin';//Присваиваем имя роли
        $auth->add($admin); //Добавляем в наш экземпляр аутменеджера роль админа

        $auth->addChild($admin,$user);  //Добавляем админу дочернюю роль юзера, чтобы админ наследовался от юзера и имел все его права
        $auth->addChild($admin, $adminPanel);   //Присваиваем админу разрешение adminPanel, по которому будем проверять доступ в админку

        $this->stdout('Done!', PHP_EOL);    //Выводим в консоли сообщение о завершении команды
    }
}