<?php

/**
 * This is the model class for table "show".
 *
 * The followings are the available columns in table 'show':
 * @property string $id
 * @property integer $catalog_id
 * @property string $admin_id
 * @property string $author
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $banner
 * @property string $template
 * @property string $click
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Show extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{show}}';
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
			array('catalog_id, status', 'numerical', 'integerOnly'=>true),
			array('admin_id, click', 'length', 'max'=>10),
			array('author, title, seo_title, seo_keywords, banner, template, redirect_url', 'length', 'max'=>255),
			array('brief, seo_description', 'length', 'max'=>1022),
			array('content, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, catalog_id, admin_id, author, title, brief, content, seo_title, seo_description, seo_keywords, banner, template, click, status, create_time, update_time', 'safe', 'on'=>'search'),
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
			'catalog_id' => '分类',
			'admin_id' => '用户',
			'author' => '作者',
			'title' => '标题',
			'brief' => '摘要',
			'content' => '内容',
			'seo_title' => 'SEO标题',
			'seo_description' => 'SEO描述',
			'seo_keywords' => 'SEO关键字',
			'banner' => 'banner图片',
			'template' => '模板',
			'redirect_url' => '外部链接',
			'click' => '查看次数',
			'status' => '状态 1正常，0禁用',
			'create_time' => '添加时间',
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
		$criteria->compare('catalog_id',$this->catalog_id);
		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('brief',$this->brief,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('template',$this->template,true);
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
	 * @return Show the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
