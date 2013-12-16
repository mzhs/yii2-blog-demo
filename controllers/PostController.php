<?php

namespace app\controllers;

use app\models\Post;
use app\Models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\AccessDeniedHttpException;
use yii\web\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
	public $layout = '@app/views/layouts/column2.php';
	public $isHome = false;

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\web\AccessControl::className(),
				'only' => ['create', 'update', 'delete'],
				'rules' => [
					[
						'actions' => ['create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Post models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index', [
			'dataProvider' => new \yii\data\ActiveDataProvider([
				'query' => Post::find()->orderBy('id desc'),
				'pagination' => ['pageSize' => 5],
			]),
		]);
	}

	/**
	 * Displays a single Post model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Post model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$this->layout = '@app/views/layouts/column1.php';

		$model = new Post;

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Post model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$this->layout = '@app/views/layouts/column1.php';

		$model = $this->findModel($id);
		if (!$model->belongsToViewer()) {
			throw new AccessDeniedHttpException('You do not have the permission to edit this post.');
		}

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Post model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		if (!$model->belongsToViewer()) {
			throw new AccessDeniedHttpException('You do not have the permission to edit this post.');
		}
		$model->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Post model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Post the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		$model = Post::find()
				->with('user')
				->where(['id' => $id])
				->one();

		if ($model === null)
			throw new NotFoundHttpException('The requested page does not exist.');

		return $model;
	}
}
