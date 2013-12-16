<?php use yii\helpers\Html; ?>
<div class="post">
	<h1 class="post-title"><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]); ?></h1>

	<div class="post-info">
		<span class="posted"><?= $model->created_at; ?></span> | <span class="author"><?= Html::encode($model->user->username); ?></span>
		<?php if ($model->belongsToViewer()): ?>
			<div class="pull-right">
				<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
				<?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
					'class' => 'btn btn-xs btn-danger',
					'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
					'data-method' => 'post',
				]); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="post-body">
		<?= \yii\helpers\HtmlPurifier::process(\yii\helpers\Markdown::process($model->body)) ?>
	</div>
</div>