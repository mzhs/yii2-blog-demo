<?php use yii\helpers\Html; ?>
<?php foreach ($comments as $comment): ?>
	<div class="comment">
		<h3 class="comment-info"><?= Html::encode($comment->username) ?> <?= $comment->created_at ?></h3>
		<p><?= nl2br(Html::encode($comment->body)) ?></p>
	</div>
<?php endforeach; ?>