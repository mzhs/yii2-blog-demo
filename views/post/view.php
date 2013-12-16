<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Post $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

	<?php echo $this->render('_view', ['model' => $model]); ?>


	<ul class="list-unstyled">
		<?php if ($newerLink = $model->newerLink()): ?>
			<li>Newer Post: <?= $newerLink ?></li>
		<?php endif; ?>
		<?php if ($olderLink = $model->olderLink()): ?>
			<li>Older Post: <?= $olderLink; ?></li>
		<?php endif; ?>
	</ul>
</div>
