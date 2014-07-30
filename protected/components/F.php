<?php
/**
 * Created by JetBrains PhpStorm.
 * User: funson
 * Date: 14-6-6
 * Time: 下午4:13
 * To change this template use File | Settings | File Templates.
 */

class F {
	/*
	 * settings get from the table settings
	 * Usage: F::sg('site', 'name');
	 */
	static function sg($category, $key)
	{
		return Yii::app()->settings->get($category, $key);
	}

	static function getStatus2($value=NULL)
	{
		$data = array(
			CONSTANT::STATUS_ACTIVE => Yii::t('common', 'STATUS_ACTIVE'),
			CONSTANT::STATUS_INACTIVE => Yii::t('common', 'STATUS_INACTIVE'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function getStatus3($value=NULL)
	{
		$data = array(
			CONSTANT::STATUS_ACTIVE => Yii::t('common', 'CONSTANT_YES'),
			CONSTANT::STATUS_INACTIVE => Yii::t('common', 'STATUS_INACTIVE'),
			CONSTANT::STATUS_DELETED => Yii::t('common', 'STATUS_DELETED'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function getYesNo($value=NULL)
	{
		$data = array(
			CONSTANT::CONSTANT_YES => Yii::t('common', 'CONSTANT_YES'),
			CONSTANT::CONSTANT_NO => Yii::t('common', 'CONSTANT_NO'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function getPageType($value=NULL)
	{
		$data = array(
			CONSTANT::PAGE_TYPE_LIST => Yii::t('common', 'PAGE_TYPE_LIST'),
			CONSTANT::PAGE_TYPE_PAGE => Yii::t('common', 'PAGE_TYPE_PAGE'),
		);
		if($value===NULL)
		{
			return $data;
		}
		else
		{
			return $data[$value];
		}
	}

	static function strpos_array($haystack, $needle)
	{
		if(!is_array($needle))
			$needle = array($needle);
		foreach($needle as $what)
		{
			if(($pos = strpos($haystack, $what))!==false)
				return $pos;
		}
		return false;
	}


}