<?php

use yii\db\Schema;

class m131211_073045_create_users_table extends \yii\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->createTable('users', [
			'id' => 'pk',
			'username'  => 'string(30) NOT NULL',
			'password'  => 'string(255) NOT NULL',
			'auth_key'  => 'string(255) NOT NULL',
		])->execute();

		$this->createIndex('username', 'users', 'username', true);
	}

	public function down()
	{
		$this->db->createCommand()->dropTable('users')->execute();
	}
}
