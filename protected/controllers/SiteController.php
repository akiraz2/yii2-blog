<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the 'page' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionPage()
	{
		//var_dump(Notice::model()->with('noticeCategory')->findAll());
		$id = $_GET['id'];
		if(0 >= $id)
			$this->redirect(Yii::app()->homeUrl);//array('/site/error')

		//get the template
		$catalog = Catalog::model()->findByPk($id);
		$templatePage = $catalog->template_page ? $catalog->template_page : 'page';

		$portlet=Catalog::getCatalogSub2($id, Catalog::model()->findAll());
		$portletTitle = Catalog::model()->findByPk(Catalog::getRootCatalogId($id, Catalog::model()->findAll()))->title;

		$this->render($templatePage,array('catalog'=>$catalog,'model'=>$catalog,'portlet'=>$portlet,'portletTitle'=>$portletTitle));
	}

	/**
	 * This is the 'page' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionList()
	{
		//var_dump(Notice::model()->with('noticeCategory')->findAll());
		$id = $_GET['id'];
		if(0 >= $id)
			$this->redirect(Yii::app()->homeUrl);//array('/site/error')

		//get the template
		$catalog = Catalog::model()->findByPk($id);
		$templatePage = $catalog->template_list ? $catalog->template_list : 'list';

		//echo Yii::app()->theme->basePath;
		//var_dump(CFileHelper::findFiles(Yii::app()->theme->basePath.'/views',array('fileTypes'=>array('php'),)));
		//get all catalog ids to show
		$ids = Catalog::getCatalogIdStr($id, Catalog::model()->findAll());
		//var_dump(Catalog::getRootCatalogId(5, Catalog::model()->findAll()));
		$portlet = Catalog::getCatalogSub2($id, Catalog::model()->findAll());
		$portletTitle = Catalog::model()->findByPk(Catalog::getRootCatalogId($id, Catalog::model()->findAll()))->title;
		//var_dump($ids);
		/*$show = Show::model()->findAll(array(
			'condition'=>"catalog_id in ( $ids ) ",
			//'params'=>array(':ids'=>$ids),
			'order'=>'id asc',
			));
		//var_dump($show);*/
		$criteria=new CDbCriteria;
		//$criteria->select='title,banner'; // only select the 'title' column
		$criteria->condition="catalog_id in ($ids)";
		//$criteria->params=array(':ids'=>$ids);
		$criteria->order='create_time DESC';

		$count=Show::model()->count($criteria);
		$pager=new CPagination($count);
		$pager->pageSize=$catalog->page_size>0 ? $catalog->page_size : 1;
		$pager->applyLimit($criteria);

		$show=Show::model()->findAll($criteria); // $params is not needed

		$this->render($templatePage,array('catalog'=>$catalog,'model'=>$show,'pages'=>$pager,'portlet'=>$portlet,'portletTitle'=>$portletTitle));
	}

	/**
	 * This is the 'page' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionShow()
	{
		$id = $_GET['id'];
		if(0 >= $id)
			$this->redirect(Yii::app()->homeUrl);

		//get the template
		$show = Show::model()->findByPk($id);
		$catalog = Catalog::model()->findByPk($show->catalog_id);
		if($show->template)
		{
			$templatePage = $show->template;
		}
		else
		{
			$templatePage = $catalog->template_page ? $catalog->template_page : 'show';
		}

		$portlet=Catalog::getCatalogSub2($show->catalog_id, Catalog::model()->findAll());
		$portletTitle = Catalog::model()->findByPk(Catalog::getRootCatalogId($id, Catalog::model()->findAll()))->title;

		$this->render($templatePage,array('catalog'=>$catalog,'model'=>$show,'portlet'=>$portlet,'portletTitle'=>$portletTitle));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


}