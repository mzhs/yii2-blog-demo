<?php

namespace app\models;

use yii\helpers\Html;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
	public static function tableName()
	{
		return 'posts';
	}

	public function rules()
	{
		return [
			[['title', 'body'], 'required'],
			[['body'], 'string'],
			[['title'], 'string', 'max' => 255],
		];
	}

	public function attributeLabels()
	{
		return [
			'id'         => 'ID',
			'user_id'    => 'User ID',
			'title'      => 'Title',
			'body'       => 'Body',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function beforeSave($insert)
	{
		if (\Yii::$app->user->isGuest) {
			throw new \yii\web\AccessDeniedHttpException('Please login.');
		}

		if (!parent::beforeSave($insert)) {
			return false;
		}

		$datetime = date('Y-m-d H:i:s');

		if ($insert) {
			$this->user_id = \Yii::$app->user->id;
			$this->created_at = $datetime;
		} elseif (!$this->belongsToViewer())
			return false;

		$this->updated_at = $datetime;

		return true;
	}

	public function beforeDelete() {
		if (!parent::beforeDelete()) {
			return false;
		}

		if (!$this->belongsToViewer())
			return false;

		return true;
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getComments()
	{
		return $this->hasMany(Comment::className(), ['post_id' => 'id']);
	}

	public function belongsToViewer()
	{
		if (\Yii::$app->user->isGuest)
			return false;

		return $this->user_id == \Yii::$app->user->id;
	}

	public function findOlderOne()
	{
		return static::find()
				->where('id < :id', [':id' => $this->id])
				->orderBy('id desc')
				->one();
	}

	public function findNewerOne()
	{
		return static::find()
				->where('id > :id', [':id' => $this->id])
				->orderBy('id asc')
				->one();
	}

	public function getNewerLink()
	{
		if (!$model = $this->findNewerOne())
			return null;

		return Html::a(Html::encode($model->title), ['post/view', 'id' => $model->id]);
	}

	public function getOlderLink()
	{
		if (!$model = $this->findOlderOne())
			return null;

		return Html::a(Html::encode($model->title), ['post/view', 'id' => $model->id]);
	}

	public function addComment(Comment $comment)
	{
		$comment->post_id = $this->id;
		return $comment->save();
	}
}
