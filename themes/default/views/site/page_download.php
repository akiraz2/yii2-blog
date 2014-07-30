<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=($catalog->seo_title ? $catalog->seo_title : $catalog->title) . ' - ' . Yii::app()->name;
$this->seoKeywords=($catalog->seo_keywords ? $catalog->seo_keywords : F::sg('site', 'siteKeywords'));
$this->seoDescription=($catalog->seo_description ? $catalog->seo_description : F::sg('site', 'siteDescription'));
$this->breadcrumbs=array(
	$catalog->title,
);
?>

<div class="main"><!--购买下载开始-->

	<div class="main_left">
		<h1><?php echo $portletTitle; ?></h1>
		<ul>
			<?php
			foreach($portlet as $item)
			{
				$url = $this->createUrl('/site/'.$item->page_type,array('id'=>$item->id));
				echo ($catalog->id == $item->id) ? '<li class="current"><a href="'.$url.'">'.$item->title.'</a></li>' : '<li><a href="'.$url.'">'.$item->title.'</a></li>';
			}
			?>
		</ul>
	</div>

	<div class="main_right">
		<h3><span>产品下载</span></h3>

		<div class="download">
			<div class="android">
				<h3>Android版</h3>
				<p class="down_intro"><span class="ver">版本：1.0</span><span class="size">大小：2M</span><span>适用平台：Android 2.3+</span></p>

				<div class="down_style down_style_01">
					<p class="down_name">扫描二维码下载</p>
					<p><a href="http://dd.myapp.com/16891/83A86279F9E4DC62603730DA2FEE3FAF.apk?fsname=com%2Exs%2Emicard%5F1%2E0%5F1.apk" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/android_code.png" width="120" height="120"></a></p>
				</div>
				<div class="down_style">
					<p class="down_name">直接下载</p>
					<p class="down_btn"><a href="http://ppt.waging.cn/ppt/images/micard.apk" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/android.png" width="189" height="57"></a></p>
				</div>
				<div class="clear"></div>
				<div class="other_down">你还可以通过 <span>安卓市场，腾讯应用宝</span>搜索 <span>"挖金"</span> 下载。</div>

			</div>

			<!--div class="apple">
			   <h3>iPhone版</h3>
			   <p class="down_intro"><span class="ver">版本：1.0</span><span class="size">大小：2M</span><span>适用平台：IOS 5.0+</span></p>

			   <div class="down_style down_style_01">
				 <p class="down_name">扫描二维码下载</p>
				 <p><a href="#"><img src="/statics/images/e_code.jpg" width="120" height="120"></a></p>
			   </div>
			   <div class="down_style">
				 <p class="down_name">直接下载</p>
				 <p class="down_btn"><a href="#"><img src="/statics/images/apple.png" width="189" height="57"></a></p>
			   </div>
			   <div class="clear"></div>
			   <div class="other_down">你还可以通过 <span>AppStore</span> 搜索 <span>"挖金"</span> 下载。</div>

			</div-->
		</div>


	</div>

</div><!--购买下载结束-->