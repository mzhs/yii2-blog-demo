<?php

namespace app\models;

use yii\helpers\Security;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	public static function tableName()
	{
		return 'users';
	}

	public function rules()
	{
		return [
			[['username', 'password'], 'required'],
			[['username'], 'string', 'max' => 30, 'min' => 3],
			[['username'], 'unique'],
			[['password', 'auth_key'], 'string', 'max' => 255]
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'auth_key' => 'Auth Key',
		];
	}

	public function beforeSave($insert)
	{
		if (!parent::beforeSave($insert)) {
			return false;
		}

		if ($this->isNewRecord) {
			$this->auth_key = Security::generateRandomKey();
		}
		return true;
	}

	public static function findIdentity($id)
	{
		return static::find($id);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey()
	{
		return $this->auth_key;
	}

	public function validateAuthKey($authKey)
	{
		return $authKey === $this->getAuthKey();
	}

	public static function register($username, $password)
	{
		$newUser = new static;
		$newUser->username = $username;
		$newUser->password = Security::generatePasswordHash($password);
		return $newUser->save();
	}

	public static function findByUsername($username)
	{
		return static::find(['username' => $username]);
	}

	public function validatePassword($password)
	{
		return Security::validatePassword($password, $this->password);
	}
}
