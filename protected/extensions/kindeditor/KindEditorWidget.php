<?php
/**
 * KindEditorWidget class file.
 * Created on 2012-08-06
 *
 * Copyright: jinmmd <jinmmd@gmail.com>
 * Based on Joe Chu's <http://about.me/aidai524> KindEditor <https://github.com/aidai524/yii-kindeditor> widget.
 * 
 * GNU LESSER GENERAL PUBLIC LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Requirements:
 * The KindEdtior have to be into:
 * <Yii-Application>/proected/extensions/kindedtior/assets
 *
 * This extension have to be installed into:
 * <Yii-Application>/proected/extensions/kindedtior
 *
 * Usage:
 * <?php $this->widget('ext.kindeditor.KindEditorWidget',array(
 *   'id'=>'Article_content',	# Textarea id
 *
 *   # Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
 *   'config' => array(
 *       'width'=>'700px',
 *       'height'=>'300px',
 *       'themeType'=>'simple',
 *       'allowFileManager'=>false,
 *       'allowImageUpload'=>false,
 *       'items'=>array(
 *           'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
 *           'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
 *           'insertunorderedlist', '|', 'emoticons', 'image', 'link',
 *   )),
 * )); ?>
 */

/**
 * KindEditor InputWidget.
 */
class KindEditorWidget extends CInputWidget
{
	public $id;
	public $language = '';

	/**
	 * @var array the kindeditor items configuration.
	 */
	public $items = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		// Prevents the extension from registering scripts and publishing assets when ran from the command line.
		if (Yii::app() instanceof CConsoleApplication)
			return;

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($this->assetsUrl.'/themes/default/default.css');
		$cs->registerCssFile($this->assetsUrl.'/themes/simple/simple.css');
		$cs->registerScriptFile($this->assetsUrl.'/kindeditor.js', CClientScript::POS_HEAD);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$script = $script.'KindEditor.ready(function(K){var editor=K.create("textarea[id='.$this->id.']", {'.$this->renderItems($this->items).'})});';
		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();
		$cs->registerScript($this->id, $script);
		$cs->registerScriptFile($this->assetsUrl.'/lang/'.$this->language.'.js', CClientScript::POS_HEAD);
	}

	/**
	 * Renders the items.
	 * @param array $items the item configuration.
	 */
	protected function renderItems($items)
	{
		$script = '';
		foreach ($items as $key => $item)
		{
			if(is_array($item))
			{
				$script = $script."'$key':[";
				foreach ($item as $value)
					$script = $script."'$value',";
				$script = $script."],";
			} else
				$script = $script."'$key':'$item',";
		}
		return $script;
	}

	public function getAssetsUrl()
	{
		$assetsPath = Yii::getPathOfAlias('ext.kindeditor.assets');
		$assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
		return $assetsUrl;
	}
}