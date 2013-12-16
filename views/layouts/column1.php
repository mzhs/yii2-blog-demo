<?php use yii\widgets\Breadcrumbs; ?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<?= $content; ?>
</div>
<?php $this->endContent(); ?>