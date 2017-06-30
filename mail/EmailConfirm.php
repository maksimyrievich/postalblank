<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/email-confirm', 'token' => $user->email_confirm_token]);
?>

Этот адрес электронной почты был указан при регистрации на сайте https:\\postalblank.ru.
Для завершения регистрации пройдите по ссылке ниже:
<br>
<br>
<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>
<br>
<br>
Если Вы не регистрировались на сайте https:\\postalblank.ru , то просто удалите это письмо.
<br>
<br>
<br>
<br>
<br>
<br>