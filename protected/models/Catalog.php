<?php

/**
 * This is the model class for table "catalog".
 *
 * The followings are the available columns in table 'catalog':
 * @property string $id
 * @property integer $parent_id
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $banner
 * @property integer $is_nav
 * @property string $sort_order
 * @property string $page_type
 * @property integer $page_size
 * @property string $template_list
 * @property string $template_show
 * @property string $template_page
 * @property string $redirect_url
 * @property string $click
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Catalog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{catalog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('parent_id, is_nav, page_size, status', 'numerical', 'integerOnly'=>true),
			array('title, seo_title, seo_keywords, banner, template_list, template_show, template_page, redirect_url', 'length', 'max'=>255),
			array('brief, seo_description', 'length', 'max'=>1022),
			array('sort_order, click', 'length', 'max'=>10),
			array('page_type', 'length', 'max'=>4),
			array('content, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, title, brief, content, seo_title, seo_keywords, seo_description, banner, is_nav, sort_order, page_type, page_size, template_list, template_show, template_page, redirect_url, click, status, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => '上级名称',
			'title' => '名称',
			'brief' => '摘要',
			'content' => '内容',
			'seo_title' => 'SEO标题',
			'seo_keywords' => 'SEO关键字',
			'seo_description' => 'SEO描述',
			'banner' => 'Banner图片',
			'is_nav' => '是否导航显示',
			'sort_order' => '排序',
			'page_type' => '类型',
			'page_size' => '每页显示数量',
			'template_list' => '列表模板',
			'template_show' => '内容页模板',
			'template_page' => '单页模板',
			'redirect_url' => '外部链接',
			'click' => '查看次数',
			'status' => '状态 1正常，0禁用',
			'create_time' => '录入时间',
			'update_time' => '更新时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('is_nav',$this->is_nav);
		$criteria->compare('sort_order',$this->sort_order,true);
		$criteria->compare('page_type',$this->page_type,true);
		$criteria->compare('page_size',$this->page_size);
		$criteria->compare('template_list',$this->template_list,true);
		$criteria->compare('template_show',$this->template_show,true);
		$criteria->compare('template_page',$this->template_page,true);
		$criteria->compare('redirect_url',$this->redirect_url,true);
		$criteria->compare('click',$this->click,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	static public function get($parentId = 0, $array = array(), $level = 0, $add = 2, $repeat = '　')
	{
		$strRepeat = '';
		if ($level>1) {
			for($j = 0; $j < $level; $j ++)
			{
				$strRepeat .= $repeat;
			}
		}
		if($level>0)
			$strRepeat .= '|—';

		$newArray = array ();
		$tempArray = array ();
		foreach ( ( array ) $array as $v )
		{
			if ($v['parent_id'] == $parentId)
			{
				$newArray [] = array ('id' => $v['id'], 'title' => $v['title'], 'parent_id' => $v['parent_id'], 'level' => $level, 'sort_order' => $v['sort_order'], 'brief' => $v['brief'],
					'content' => $v['content'], 'seo_title' => $v['seo_title'], 'seo_keywords' => $v['seo_keywords'], 'seo_description' => $v['seo_description'], 'banner' => $v['banner'],
					'is_nav' => $v['is_nav'], 'page_size' => $v['page_size'],'template_list' => $v['template_list'],'template_show' => $v['template_show'],'template_page' => $v['template_page'],
					'create_time' => $v['create_time'], 'update_time' => $v['update_time'], 'redirect_url' => $v['redirect_url'], 'str_repeat' => $strRepeat, 'str_label' => $strRepeat.$v['title'],);

				$tempArray = self::get ( $v['id'], $array, ($level + $add) );
				if ($tempArray)
				{
					$newArray = array_merge ( $newArray, $tempArray );
				}
			}
		}
		return $newArray;
	}

	static public function getCatalog($parentId=0,$array = array())
	{
		$newArray=array();
		foreach ((array)$array as $v)
		{
			if ($v['parent_id']==$parentId)
			{
				$newArray[$v['id']]=array(
					'text'=>$v['title'].' 导航['.($v['is_nav'] ? Yii::t('common', 'CONSTANT_YES') : Yii::t('common', 'CONSTANT_NO')).'] 排序['.$v['sort_order'].'] 类型['.($v['page_type'] == 'list' ? Yii::t('common', 'PAGE_TYPE_LIST') : Yii::t('common', 'PAGE_TYPE_PAGE')).'] 状态['.F::getStatus2($v['status']).'] [<a href="'.Yii::app()->createUrl('/catalog/update',array('id'=>$v['id'])).'">修改</a>][<a href="'.Yii::app()->createUrl('/catalog/create',array('id'=>$v['id'])).'">增加子菜单</a>]&nbsp;&nbsp[<a href="'.Yii::app()->createUrl('/catalog/delete',array('id'=>$v['id'])).'">删除</a>]',
					//'children'=>array(),
				);

				$tempArray = self::getCatalog($v['id'],$array);
				if($tempArray)
				{
					$newArray[$v['id']]['children']=$tempArray;
				}
			}
		}
		return $newArray;
	}

	static public function getCatalogIdStr($parentId=0,$array = array())
	{
		$str = $parentId;
		foreach ((array)$array as $v)
		{
			if ($v['parent_id']==$parentId)
			{

				$tempStr = self::getCatalogIdStr($v['id'],$array);
				if($tempStr)
				{
					$str .= ','.$tempStr;
				}
			}
		}
		return $str;
	}

	static public function getRootCatalogId($id=0,$array = array())
	{
		if(0 == $id)
		{
			return 0;
		}

		foreach ((array)$array as $v)
		{
			if ($v['id']==$id)
			{
				$parentId = $v['parent_id'];
				if(0 == $parentId)
					return $id;
				else
					return self::getRootCatalogId($parentId,$array);
			}
		}
	}

	static public function getCatalogSub2($id=0,$array = array())
	{
		if(0 == $id)
		{
			return 0;
		}

		$arrayResult = array();
		$rootId = Catalog::getRootCatalogId($id, $array);
		foreach ((array)$array as $v)
		{
			if ($v['parent_id']==$rootId)
			{
				array_push($arrayResult, $v);
			}
		}

		return $arrayResult;
	}

	static public function getBreadcrumbs($id=0,$array = array())
	{
		if(0 == $id)
		{
			return;
		}

		$arrayResult = Catalog::getPathToRoot($id, $array);

		return array_reverse($arrayResult);
	}

	static public function getPathToRoot($id=0,$array = array())
	{
		if(0 == $id)
		{
			return array();
		}

		$arrayResult=array();
		$parent_id = 0;
		foreach ((array)$array as $v)
		{
			if($v['id']==$id)
			{
				$parent_id = $v['parent_id'];
				if(CONSTANT::PAGE_TYPE_LIST == $v['page_type'])
					$arrayResult = array($v['title']=>array('list', id=>$v['id']));
				elseif(CONSTANT::PAGE_TYPE_PAGE == $v['page_type'])
					$arrayResult = array($v['title']=>array('page', id=>$v['id']));
			}
		}

		if(0 < $parent_id)
		{
			$arrayTemp = Catalog::getPathToRoot($parent_id,$array);

			if(!empty($arrayTemp))
				$arrayResult += $arrayTemp;
		}

		if(!empty($arrayResult))
			return $arrayResult;
		else
			return;
	}
}
