<?php

namespace app\models;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $username
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'comments';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['body'], 'required'],
			[['body'], 'string', 'max' => 2000],
			[['username'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'post_id' => 'Post ID',
			'username' => 'Name',
			'body' => 'Body',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function beforeSave($insert) {
		if (!parent::beforeSave($insert))
			return false;

		$datetime = date('Y-m-d H:i:s');
		if ($insert)
			$this->created_at = $datetime;
		$this->updated_at = $datetime;

		if ($this->username === '')
			$this->username = 'No Name';

		return true;
	}
}
