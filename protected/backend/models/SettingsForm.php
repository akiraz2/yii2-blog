<?php
/**
 * Created by JetBrains PhpStorm.
 * User: funson
 * Date: 14-6-6
 * Time: 下午2:45
 * To change this template use File | Settings | File Templates.
 */
class SettingsForm extends CFormModel
{

	public $site = array(
		'name' => '',
		'domain' => '',
		'googleAPIKey' => '',
		'numSearchResults' => '',
		'defaultLanguage' => '',
		'template' => '',
		'about' => '',
		'statistics' => '',
	);
	public $seo = array(
		'siteTitle' => '',
		'siteKeywords' => '',
		'siteDescription' => '',
	);
	public $mail = array(
		'adminEmail' => '',
		'fromReply' => '',
		'fromNoReply' => '',
		'server' => '',
		'port' => '',
		'user' => '',
		'password' => '',
		'ssl' => '',
	);
	public $filter = array(
		'filter1'=>'',
		'filter2'=>'',
	);

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function getAttributesLabels($key)
	{
		$keys = array(
			'site' => '站点',
			'seo' => 'SEO',
			'mail' => '邮件',
			'filter' => '过滤',
			'name' => '网站名称',
			'domain' => '站点域名',
			'googleAPIKey' => 'Google API密钥',
			'numSearchResults' => '搜索结果数量',
			'defaultLanguage' => '默认',
			'template' => '模板名称',
			'about' => '本站简介',
			'statistics' => '统计代码',
			'siteTitle' => 'SEO标题',
			'siteKeywords' => 'SEO关键字',
			'siteDescription' => 'SEO描述',
			'adminEmail' => '管理员邮箱',
			'fromReply' => '发送邮箱地址',
			'fromNoReply' => '不回复邮箱地址',
			'server' => 'SMTP主机',
			'port' => 'SMTP端口',
			'user' => 'SMTP用户名',
			'password' => 'SMTP密码',
			'ssl' => 'SSL',
			'filter1'=>'过滤1',
			'filter2'=>'过滤2',
		);

		if(array_key_exists($key, $keys))
			return $keys[$key];

		$label = trim(strtolower(str_replace(array('-', '_'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $key))));
		$label = preg_replace('/\s+/', ' ', $label);

		if (strcasecmp(substr($label, -3), ' id') === 0)
			$label = substr($label, 0, -3);

		return ucwords($label);
	}

	/**
	 * Sets attribues values
	 * @param array $values
	 * @param boolean $safeOnly
	 */
	public function setAttributes($values,$safeOnly=true)
	{
		if(!is_array($values))
			return;

		foreach($values as $category=>$values)
		{
			if(isset($this->$category)) {
				$cat = $this->$category;
				foreach ($values as $key => $value) {
					if(isset($cat[$key])){
						$cat[$key] = $value;
					}
				}
				$this->$category = $cat;
			}
		}
	}
}