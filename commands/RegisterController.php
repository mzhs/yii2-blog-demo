<?php

namespace app\commands;

class RegisterController extends \yii\console\Controller
{
	public function actionIndex($username, $password)
	{
		if (\app\models\User::register($username, $password)) {
			echo 'created a new user.', "\n";
		} else {
			echo "failed.\n";
		}
	}
}