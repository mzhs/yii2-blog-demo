<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<?php
		NavBar::begin([
			'brandLabel' => Html::encode(\Yii::$app->name),
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		echo Nav::widget([
			'encodeLabels' => false,
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => 'Home', 'url' => \Yii::$app->homeUrl, 'active' => isset($this->params['isHome']) && $this->params['isHome'] === true],
				['label' => 'About', 'url' => ['/site/about']],
				\Yii::$app->user->isGuest
				?['label' => 'Login', 'url' => ['/site/login']]
				:[
					'label' => '<span class="glyphicon glyphicon-user"></span> ' . Html::encode(\Yii::$app->user->identity->username),
					'items' => [
						[
							'label' => '<span class="glyphicon glyphicon-pencil"></span>Create Post',
							'url' => ['/post/create'],
							'linkOptions' => ['data-method' => 'post'],
						],
						'<li class="divider"></li>',
						[
							'label' => '<span class="glyphicon glyphicon-off"></span> Logout',
							'url' => ['/site/logout'],
							'linkOptions' => ['data-method' => 'post'],
						]
					]
				]
			]
		]);
		NavBar::end();
	?>

	<?= $content ?>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; <?= Html::encode(\Yii::$app->name) ?> <?= date('Y') ?></p>
			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
