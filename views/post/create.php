<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Post $model
 */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
