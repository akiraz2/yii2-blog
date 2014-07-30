<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

	public $mainMenu=array(
	);
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $seoKeywords='';
	public $seoDescription='';

	public function beforeAction($action)
	{
		$this->mainMenu = array((array('label'=>Yii::t('common','Home'), 'url'=>array('/site/index'))));

		$dynamicTheme = F::sg('site', 'template');
		if(strlen($dynamicTheme) > 0)
			Yii::app()->theme=$dynamicTheme;
		else
			Yii::app()->theme='default';
		if(strpos(Yii::app()->request->url, 'wap') !== false)
			Yii::app()->theme='wap';

		//menu
		$id = (int)$_GET['id'];
		$rootId = ($id>0) ? Catalog::getRootCatalogId($id, Catalog::model()->findAll()) : 0;
		$allCatalog = Catalog::model()->findAll(array('condition'=>"parent_id=0",'order'=>'sort_order asc'));
		foreach($allCatalog as $catalog)
		{
			$item=array();
			if($catalog->redirect_url)
			{// redirect to other site
				$item=array('label'=>$catalog->title, 'url'=>$catalog->redirect_url, 'active'=>($catalog->id==$rootId));
			}
			else
			{
				if('list' == $catalog->page_type)
					$item=array('label'=>$catalog->title, 'url'=>array('/site/list/','id'=>$catalog->id), 'active'=>($catalog->id==$rootId));
				else
					$item=array('label'=>$catalog->title, 'url'=>array('/site/page/','id'=>$catalog->id), 'active'=>($catalog->id==$rootId));
			}

			if(!empty($item))
				array_push($this->mainMenu, $item);
		}

		return parent::beforeAction($action);
	}
}