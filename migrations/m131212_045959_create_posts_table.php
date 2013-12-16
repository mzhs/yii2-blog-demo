<?php

use yii\db\Schema;

class m131212_045959_create_posts_table extends \yii\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->createTable('posts', [
			'id'         => 'pk',
			'user_id'    => 'int NOT NULL',
			'title'      => 'string NOT NULL',
			'body'       => 'text',
			'created_at' => 'datetime NOT NULL',
			'updated_at' => 'datetime NOT NULL',
		])->execute();

		$this->createIndex('user_id', 'posts', 'user_id', false);
	}

	public function down()
	{
		$this->db->createCommand()->dropTable('posts')->execute();
	}
}
