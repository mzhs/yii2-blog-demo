<?php

namespace app\widgets;

use app\models\Post;
use yii\helpers\Html;

class RecentPosts extends \yii\base\Widget
{
	public function run()
	{
		if(isset(\Yii::$app->params['recentPosts']) && is_int(\Yii::$app->params['recentPosts'])) {
			$limit = \Yii::$app->params['recentPosts'];
		} else {
			$limit = 5;
		}

		$posts = Post::find()
				->orderBy('id desc')
				->limit($limit)
				->all();

		if (empty($posts)) {
			echo '<p>No posts to display.</p>';
		} else {
			echo '<ul class="list-unstyled">' . $this->renderPosts($posts) . '</ul>';
		}
	}

	public function renderPosts($posts)
	{
		$items = [];
		foreach ($posts as $post) {
			$items[] = $this->renderPost($post);
		}

		return implode("\n", $items);
	}

	public function renderPost($post)
	{
		return '<li>' . Html::a(Html::encode($post->title), ['post/view', 'id' => $post->id]) . '</li>';
	}
}