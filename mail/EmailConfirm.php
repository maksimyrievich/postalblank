<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/email-confirm', 'token' => $user->email_confirm_token]);
?>

Ваш адрес электронной почты был указан при регистрации на сайте https://postalblank.ru .<br>
Для завершения регистрации пройдите по ссылке ниже:
<br>
<br>
<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>
<br>
<br>
Если Вы не регистрировались на этом сайте, то просто удалите это письмо.
<br>
<br>
<br>
<br>
<br>
<br>