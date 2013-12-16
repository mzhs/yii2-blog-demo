<?php

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use app\widgets\Item;

?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container">
	<?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<div class="row">
		<div class="col-xs-9">
			<?= $content; ?>
		</div>
		<div class="col-xs-3 sidebar">
			<?php echo Item::widget([
				'options' => ['class' => 'recent-posts'],
				'header' => 'Recent Posts',
				'body' => app\widgets\RecentPosts::widget()
			]); ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>