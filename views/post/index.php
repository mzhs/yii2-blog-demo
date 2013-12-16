<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\Models\PostSearch $searchModel
 */

$this->title = 'Posts';
$this->params['isHome'] = true;
?>
<div class="post-index">
	<?php echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'itemView' => function ($model, $key, $index, $widget) {
			return $this->render('_view', ['model' => $model]);
		},
		'layout' => '{items}<div class="pager-wrapper">{pager}</div>'
	]); ?>

</div>
