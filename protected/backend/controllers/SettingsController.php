<?php
/**
 * Created by JetBrains PhpStorm.
 * User: funson
 * Date: 14-6-6
 * Time: 下午2:43
 * To change this template use File | Settings | File Templates.
 */
class SettingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	public function actionIndex()
	{
		$settings = Yii::app()->settings;

		$model = new SettingsForm();

		if (isset($_POST['SettingsForm'])) {
			$model->setAttributes($_POST['SettingsForm']);
			$settings->deleteCache();
			foreach($model->attributes as $category => $values){
				$settings->set($category, $values);
			}
			Yii::app()->user->setFlash('success', 'Site settings were updated.');
			$this->refresh();
		}
		foreach($model->attributes as $category => $values){
			$cat = $model->$category;
			foreach($values as $key=>$val){
				$cat[$key] = $settings->get($category, $key);
			}
			$model->$category = $cat;
		}
		$this->render('index', array('model' => $model));
	}

}