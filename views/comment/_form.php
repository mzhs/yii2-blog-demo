<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comment-form">

	<h2>Leave a Comment</h2>

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

		<div class="form-group">
			<?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
