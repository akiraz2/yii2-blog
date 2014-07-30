<?php

class CatalogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','admin','delete'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Catalog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$template = F::sg('site', 'template') ? F::sg('site', 'template') : 'default';
		$arrayTpl = CFileHelper::findFiles(dirname(Yii::app()->BasePath).'/themes/'.$template.'/views',array('fileTypes'=>array('php'),));
		$arrTpl = array();
		foreach($arrayTpl as $tpl)
		{
			$tplName = substr(pathinfo($tpl,PATHINFO_BASENAME), 0, strpos(pathinfo($tpl,PATHINFO_BASENAME), '.'));
			if(strpos($tplName, 'page') !== false)
				$arrTpl['page'][$tplName] = $tplName;
			elseif(strpos($tplName, 'list') !== false)
				$arrTpl['list'][$tplName] = $tplName;
			elseif(strpos($tplName, 'show') !== false)
				$arrTpl['show'][$tplName] = $tplName;
		}

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];

			//banner
			if($_FILES['Catalog']['name']['banner'])
			{
				$relativePath = 'assets/upload/'.date('Y').'/'.date('md');
				$bannerPath = dirname(Yii::app()->basePath).'/'.$relativePath;
				$bannerUrl = Yii::app()->baseUrl.'/'.$relativePath;
				if(!is_dir($bannerPath))
					CFileHelper::copyDirectory($bannerPath,$bannerPath);
				$uploaded = Yii::app()->file->set('Catalog[banner]');
				$banner = $uploaded->copy($bannerPath . '/' . date('YmdHis') . rand(1000,9999) . '.' . $uploaded->extension);
				$model->banner = $bannerUrl . '/' . $banner->basename;
			}

			$model->create_time=new CDbExpression('NOW()');

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'data'=>$arrTpl,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$oldBanner = $model->banner;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$template = F::sg('site', 'template') ? F::sg('site', 'template') : 'default';
		$arrayTpl = CFileHelper::findFiles(dirname(Yii::app()->BasePath).'/themes/'.$template.'/views',array('fileTypes'=>array('php'),));
		$arrTpl = array();
		foreach($arrayTpl as $tpl)
		{
			$tplName = substr(pathinfo($tpl,PATHINFO_BASENAME), 0, strpos(pathinfo($tpl,PATHINFO_BASENAME), '.'));
			if(strpos($tplName, 'page') !== false)
				$arrTpl['page'][$tplName] = $tplName;
			elseif(strpos($tplName, 'list') !== false)
				$arrTpl['list'][$tplName] = $tplName;
			elseif(strpos($tplName, 'show') !== false)
				$arrTpl['show'][$tplName] = $tplName;
		}

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];

			//banner
			if($_FILES['Catalog']['name']['banner'])
			{
				$relativePath = 'assets/upload/'.date('Y').'/'.date('md');
				$bannerPath = dirname(Yii::app()->basePath).'/'.$relativePath;
				$bannerUrl = Yii::app()->baseUrl.'/'.$relativePath;
				if(!is_dir($bannerPath))
					CFileHelper::copyDirectory($bannerPath,$bannerPath);
				$uploaded = Yii::app()->file->set('Catalog[banner]');
				$banner = $uploaded->copy($bannerPath . '/' . date('YmdHis') . rand(1000,9999) . '.' . $uploaded->extension);
				$model->banner = $bannerUrl . '/' . $banner->basename;
			}
			else
				$model->banner = $oldBanner;

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'data'=>$arrTpl,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Catalog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Catalog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catalog']))
			$model->attributes=$_GET['Catalog'];

		$dataProvider=Catalog::getCatalog(0, Catalog::model()->findAll());

		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Catalog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Catalog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Catalog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='catalog-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
