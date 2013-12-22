<?php

use yii\db\Schema;

class m131221_033944_create_comments_table extends \yii\db\Migration
{
	public function up()
	{
		$this->db->createCommand()->createTable('comments', [
			'id'         => 'pk',
			'post_id'    => 'int NOT NULL',
			'username'   => 'string NOT NULL',
			'body'       => 'text',
			'created_at' => 'datetime NOT NULL',
			'updated_at' => 'datetime NOT NULL',
		])->execute();

		$this->createIndex('post_id', 'comments', 'post_id', false);
	}

	public function down()
	{
		$this->db->createCommand()->dropTable('comments');
	}
}
